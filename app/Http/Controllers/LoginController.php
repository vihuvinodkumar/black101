<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Exception;
use Carbon\Carbon;

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
                return response()->json([
                    "message"=>"login successfully",
                    "code"=>200,
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

    public function updateUser(Request $request, $id)
    {
        try {
            $request->validate([
                "profile_photo" => "required"
            ]);

            $user = Login::select(["*"])->where("id", $id)->update($request->all());
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

        $check = Login::where([['created_at','>', $date],["is_donated",'']])->get();
        if($check->count() > 0){
             return response()->json([
                "message"=>"your triel expire please donate",
                "code"=>400
             ])->setStatusCode(400);
        }
        return response()->json([
            "message"=>"your expire few days left please donate",
            "code"=>200
        ]);
    }
}
