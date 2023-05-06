<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    
    public function sendSms(Request $request)
    {
        $sid    = env('TWILIO_ACCOUNT_SID');
        $token  = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
                          ->create($request->to,
                                   array(
                                       "body" => $request->message,
                                       "from" => env('TWILIO_PHONE_NUMBER')
                                   )
                          );

        return response()->json([
            'status' => 'success',
            'message' => 'SMS sent successfully.',
            'data' => $message,
        ]);
    }
}
