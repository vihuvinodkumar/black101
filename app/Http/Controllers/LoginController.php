<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\PasswordReset;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $userDetails = Login::select(["*"])->where("email", $request->email)->get();
        if (count($userDetails) > 0) {
            if ($request->password === $userDetails[0]->password) {
                $payload = JWTFactory::sub($userDetails[0]->id)->myCustomObject($userDetails)->make();
                $token = JWTAuth::fromUser($userDetails[0], $payload);

                $fmcToken = Login::firstOrNew([]);
                $fmcToken->device_token = $request->device_token;
                $fmcToken->update();;
                
                return response()->json([
                    "message" => "login successfully",
                    "code" => 200,
                    "token" => $token,
                    "data" => $userDetails
                ]);
            } else {
                return response()->json([
                    "message" => "password not matched",
                    "code" => 400
                ])
                    ->setStatusCode(400);
            }
        }
        return response()->json([
            "message" => "user not found",
            "code" => 400
        ])
            ->setStatusCode(400);
    }


    public function saveUser(Request $request)
{
    try {
        // $request->validate([
        //     "name"=>"required",
        //     "email" => "required|regex:/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/",
        //     "password" => "required"
        // ]);

        $check_user = Login::select(["*"])->where("email", $request->email)->get();
        if (count($check_user) > 0) {

            return response()->json([
                "message" => "user already exists with this details",
                "user_details" => $check_user,
                "payload" => $request->all(),
                "code" => 400
            ])
            ->setStatusCode(400);
        }
       
        // Set default profile photo path if not provided in the request
        if(!$request->has('profile_photo')) {
            $request['profile_photo'] = "public/tasks/document/p2RLVeRHpGvXk5clSPPg2uxhJoFbJdWp3trGPesf.jpg";
        }

        $userResult = Login::create($request->all());
        if ($userResult) {
            return response()->json([
                "message" => "user created, now you can login",
                "code" => 200,
                "userDetails" => $userResult
            ]);
        } else {
            return response()->json([
                "message" => "unable to create user",
                "code" => 200
            ])
            ->setStatusCode(400);
        }
    } catch (Exception $e) {
        return response()->json([
            "message" => "user insertion failed. Check payload.",
            "code" => 400,
            "error_message" => $e
        ])
        ->setStatusCode(400);
    }
}

    public function updateUser(Request $request)
    {
        $auth = $this->decryptt($request->header("Authorization"));
        $auth_id = $auth[0]["id"];

        try {
            $request->validate([
                "profile_photo" => "required"
            ]);

            $user = Login::select(["*"])->where("id", $auth_id)->update($request->all());
            if ($user) {
                return response()->json([
                    "message" => "profile updated...",
                    "status" => true,
                    "data" => Login::select(["*"])->where("id", $auth_id)->get()
                ]);
            }
            return response()->json([
                "message" => "Id not found",
                "code" => 400
            ])
                ->setStatusCode(400);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "user update fail please check payload",
                "code" => 400,
                "error_message" => $e
            ]);
        }
    }

    public function saveImage(Request $request)
    {
        try {

            if ($request->hasFile("file")) {
                // return $request->file('file')->store('public/tasks/document');
                $path = $request->file('file')->store('public/tasks/document');
                return response()->json(['path' => $path], 200);
            } else {
                return response()->json(["code" => 400, "message" => "error while getting file"])->setStatusCode(400);
            }
        } catch (Exception $e) {

            return response()->json(["code" => 400, "message" => "error", "error" => $e])->setStatusCode(400);
        }
    }


    public function checkUserDonation(Request $request)
    {

        $auth = $this->decryptt($request->header("Authorization"));
        $auth_id = $auth[0]["id"];

        $check = Login::where("id", $auth_id)->get();

        if (count($check) > 0) {
            $donation = Donate::select("*")->where("user_id", $auth_id)->get();
            if (count($donation) > 0) {
                return response()->json(["code" => 200, "message" => "donation success", "is_donated" => 'Y']);
            } else {
                return response()->json([
                    "message" => "you havent donated yet",
                    "code" => 200,
                    "data" => $check,
                    "is_donated" => 'N'
                ]);
            }
        }
        return response()->json([
            "message" => "user not found",
            "code" => 400,
        ])->setStatusCode(400);
    }

    // send mail for mail verication------

    public function sendVerifiedMail(Request $req, $email)
    {
        $auth = true;
        // $auth = $this->decryptt($req->header("Authorization"));
        // $auth_id = $auth[0]["id"];
        // $auth_email = $auth[0]['email'];

        if ($auth) {
            $user = Login::where('email', $email)->get();
            if (count($user) > 0) {

                $random = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . '/verify-mail/' . $random;

                $data['url'] = $url;
                $data['email'] = $email;
                $data['title'] = "Email verification";
                $data['body'] = "Please click to here below to verify your mail.";

                Mail::send('verifyMail', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });

                $user = Login::find($user[0]['id']);
                $user->remember_token = $random;
                $user->save();

                return response()->json(['success' => true, 'message' => 'Mail send successfuly....']);
            } else {
                return response()->json(['success' => false, 'message' => 'User not found...!'])->setStatusCode(400);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'User is not authenticated'])->setStatusCode(400);
        }
    }

    public function verificationMail($token)
    {
        $user = Login::where('remember_token', $token)->get();
        if (count($user) > 0) {

            $datetime = Carbon::now()->format('Y-m-d H:i:s');

            $user = Login::find($user[0]['id']);
            $user->remember_token = '';
            $user->is_verified = 1;
            $user->email_verified_at = $datetime;
            $user->save();

            return "<h1> Email verified successfuly..... <h1>";
        } else {
            return view('404');
        }
    }

    // forget password ----

    public function forgetPassword(Request $request)
    {
        try {
            $user = Login::select(["*"])->where("email", $request->email)->get();

            if (count($user) > 0) {

                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . '/reset-password?token=' . $token;

                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = "Reset Password";
                $data['body'] = "Please click to here below to password reset.";

                Mail::send('resetPassword', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });

                $datetime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $datetime
                    ]
                );

                return response()->json([
                    "success" => true,
                    "message" => "please check your mail for reset your password"
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "user not found !"
                ])->setStatusCode(400);
            }
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    // reset password view load-----

    public function resetPasswordLoad(Request $request)
    {
        $resetData = PasswordReset::where('token', $request->token)->get();
        if (isset($request->token) && count($resetData) > 0) {

            $user = Login::where('email', $resetData[0]['email'])->get();
            return view('resetPasswordForm', compact('user'));
        } else {
            return view('404');
        }
    }

    // reset password functionality----

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = Login::find($request->id);
        $user->password = $request->password;
        $user->save();

        PasswordReset::where("email", $user->email)->delete();

        return "<h1> Your password has been reset successfully </h1>";
    }

    public function decryptt($token)
    {
        $exptoken = explode(".", $token);
        $tokenPayload = base64_decode($exptoken[1]);
        $jwtPayload = json_decode($tokenPayload, true);
        return $jwtPayload['myCustomObject'];
    }
}
