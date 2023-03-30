<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
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
            'email'=>'required',
            'password'=>'required'
        ]);

        $userDetails = Login::select(["*"])->where("email", $request->email)->get();
        if(count($userDetails) > 0 ){
            if($request->password === $userDetails[0]->password){
                $payload = JWTFactory::sub($userDetails[0]->id)->myCustomObject($userDetails)->make();
                $token = JWTAuth::fromUser($userDetails[0], $payload);
                return response()->json([
                    "message"=>"login successfully",
                    "code"=>200,
                    "token"=>$token,
                    "data"=>$userDetails
                ]);
            }else{
                return response()->json([
                    "message"=>"password not matched",
                    "code"=>400
                ])
                ->setStatausCode(400);
            }
        }
        return response()->json([
            "message"=>"user not found",
            "code"=>400
        ])
        ->setStatusCode(400);
    }


    public function saveUser(Request $request)
    {
        try {
            $request->validate([
                "name"=>"required",
                "email" => "required|regex:/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/",
                "password" => "required"
            ]);

            $check_user = Login::select(["*"])->where("email", $request->email)->get();
            if(count($check_user) > 0 ){

                return response()->json([
                    "message"=>"user already exist with this details",
                    "user_details"=>$check_user,
                    "payload"=>$request->all(),
                    "code"=>400
                ])
                ->setStatusCode(400);
            }

            $useResult = Login::create($request->all());
            if($useResult){
                return response()->json([
                    "message"=>"user created, now you can login",
                    "code"=>200,
                    "userDetails"=>$useResult
                ]);
            }else{
                return response()->json([
                    "message"=>"unable to create user",
                    "code"=>200
                ])
                ->setStatusCode(400);
            }
        } catch (\Exception $e) {
            return response()->json([
                "message"=>"user insertion fail check payload",
                "code"=>400,
                "error_message"=>$e
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
            if($user){
                return response()->json([
                    "message"=>"profile updated...",
                    "status"=>true
                ]);
            }
            return response()->json([
                "message"=>"Id not found",
                "code"=>400
            ])
            ->setStatusCode(400);

        } catch (\Exception $e) {
            return response()->json([
                "message"=>"user update fail please check payload",
                "code"=>400,
                "error_message"=>$e
            ]);
        }
    }

    public function saveImage(Request $request)
    {
        return $request->file('file')->store('public/tasks/document');
    }

    public function checkUserDonation(Request $request)
    {
        $date = Carbon::now()->subDay(7);

        $check = Login::where('created_at','<', $date)->get();
       if(count($check) > 0){
        return response()->json([
            "message"=>"your access doration expire please donate",
            "code"=>400,
            "userDetails"=>$check
        ])
        ->setStatusCode(400);
       }
       return response()->json([
        "message"=>"your triel not end",
        "code"=>200
       ]);
    }

    public function sendVerifiedMail(Request $req)
    {
        
        $auth = $this->decryptt($req->header("Authorization"));
        $auth_id = $auth[0]["id"];
        $auth_email = $auth[0]['email'];

        if($auth){
            $user = Login::where('email', $auth_email)->get();
            if(count($user) > 0){

                $random = Str::random(40);
                $domain = URL::to('/');
                $url = $domain.'/verify-mail/'.$random;

                $data['url'] = $url;
                $data['email'] = $auth_email;
                $data['title'] = "Email verification";
                $data['body'] = "Please click to here below to verify your mail.";

                Mail::send('verifyMail',['data'=>$data], function($message) use ($data){
                    $message->to($data['email'])->subject($data['title']);
                });

                $user = Login::find($user[0]['id']);
                $user->remember_token = $random;
                $user->save();

                return response()->json(['success'=>true, 'message'=>'Mail send successfuly....']);

            }else{
                return response()->json(['success'=>false, 'message'=>'User not found...!']);
            }
        }else{
            return response()->json(['success'=>false, 'message'=>'User is not authenticated']);
        }
    }

    public function verificationMail($token)
    {
        $user = Login::where('remember_token', $token)->get();
        if(count($user) > 0){

            $datetime = Carbon::now()->format('Y-m-d H:i:s');

            $user = Login::find($user[0]['id']);
            $user->remember_token = '';
            $user->is_verified = 1;
            $user->email_verified_at = $datetime;
            $user->save();

            return "<h1> Email verified successfuly..... <h1>"; 

        }else{
            return view('404');
        }
    }

    public function decryptt($token) {
        $exptoken = explode(".", $token);
          $tokenPayload = base64_decode($exptoken[1]);
          $jwtPayload = json_decode($tokenPayload, true);
          return $jwtPayload['myCustomObject'];
    }
}
