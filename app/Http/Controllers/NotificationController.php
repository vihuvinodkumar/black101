<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Notification;
use Exception;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index()
    {
        return view('pushNotification');
    } 

     public function sendNotification(Request $request)
    {
        $firebaseToken = Login::whereNotNull('device_token')->pluck('device_token')->all();
            
        $SERVER_API_KEY = env('FCM_SERVER_KEY');
    
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,  
            ]
        ];
        $dataString = json_encode($data);
      
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
      
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                 
        $response = curl_exec($ch);
    
        return back()->with('success', 'Notification send successfully.');
    }

    public function saveNotification(Request $request)
    {
        $auth = $this->decryptt($request->header("Authorization"));
        $auth_id = $auth[0]["id"];

        try {
        $validatedData = $request->validate([
            'notification_text' => 'required|string',
            'is_view' => 'required',
            'type' => 'required|string'
        ]);

        $notification = new Notification;
        $notification->notification_text = $request->notification_text;
        $notification->is_view = $request->is_view;
        $notification->user_id = $auth_id;
        $notification->published_at = Carbon::now()->format('Y-m-d H:i:s');
        $notification->type = $request->type;

        $notification->save();
        if($notification){

            return response()->json([
                'code' => 200,
                'message' => 'Notification created successfully',
                'notification' => $notification
            ]);
        }
            return response()->json([
                'code' => 400,
                'message' => 'Unable to create notification'
            ])
            ->setStatusCode(400);

        } catch (\Exception $e) {
            return response()->json([
                "code"=>400,
                "error_message"=>$e->getMessage()
            ])
            ->setStatusCode(400);
        }
    }

    public function getAllViewedNotification()
    {
        $check = Notification::select(["*"])->where('is_view', 'Y')->get();

        if(count($check) > 0)
        {
            return response()->json([
                'code' => 200,
                'message' => 'List of viewed notification',
                'notification' => $check
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Unable to get notification'
        ])
        ->setStatusCode(400);
    }

    public function getAllNotViewedNotification()
    {
        
        $check = Notification::select(["*"])->where('is_view', 'N')->get();

        if(count($check) > 0)
        {
            return response()->json([
                'code' => 200,
                'message' => 'List of not viewed notification',
                'notification' => $check
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Unable to get notification list'
        ])
        ->setStatusCode(400);
    }

    public function getNotificationByUserID(Request $request)
    {
        $auth = $this->decryptt($request->header("Authorization"));
        $auth_id = $auth[0]["id"];

        $notification = Notification::select(["*"])->where('user_id', $auth_id)->get();
        if(count($notification) > 0 )
        {
            return response()->json([
                'code' => 200,
                'message' => 'List of notification by user id',
                'notification' => $notification
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'not found'
        ])
        ->getStatusCode(400);

    }

    public function deleteNotification($id)
    {
        $result = Notification::where('id', $id)->delete();
        if($result){
            return response()->json([
                'code' => 200,
                'message' => 'Notification deleted !'
            ]);
        }
        return response()->json([
            'code' => 400,
            'message' => 'Not found !'
        ])
        ->setStatusCode(400);
    }

    public function decryptt($token)
    {
        $exptoken = explode(".", $token);
        $tokenPayload = base64_decode($exptoken[1]);
        $jwtPayload = json_decode($tokenPayload, true);
        return $jwtPayload['myCustomObject'];
    }



    
}
