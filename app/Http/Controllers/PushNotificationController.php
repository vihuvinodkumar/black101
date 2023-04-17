<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\ServiceAccount;



class PushNotificationController extends Controller
{
    public function pushNotification(Request $request)
    {
        
        $serviceAccount = ServiceAccount::fromValue([
            'type' => 'service_account',
            'project_id' => 'bizooda',
            'private_key_id' => 'aad89b8f840509b3154549aef4af7fae66779f38',

            'private_key' => '-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCPSbxxfOuk7djL\nkxoQOow2Y5V1mCk3qjUw2vRAYxX0NKrNuYcGsdqD7GJtop2/wwSfoQh+Egvv3O22\n/mqQiA6egRm2wdyxFoBmmVemPmsQyj9VWoWpmxjN6+AiMJjio5NcefKhLNmDwE1v\nkjqvcHVzEXy8rTxLKm2fFMD9vQXQ2NIu+5WEG6JR+pVhAAd02gYotNxOH9IMYgiV\nMhSXW6Z6/xsAvn97vFWs/woRHfrdV/Vt13oVRHoVzKUODrRB47eDJcElM5sD1LbG\n5h5g5f9UpoHTviKD0pMZeBf64ViIMgLfEkW8bRgrhnwevgTaLrffvtnxuntSsEsE\n6tlZgierAgMBAAECggEACeQhKgRhj+ULTiI9bllcTHTbYF68macaPOEgc0FjxpPM\nJp9j/sZQO0MaGE9dbFtd+lb3axx7zncFwdgWKxv5Rl/LEp6XSXIwMuTq9ALjCSms\n7YtuJqMaNzzNIA8SvrJj/cI9SXr7GOkxbz485tdwhBz062FaBCZNoumf2OQvfpce\nl9Fq+10TpLk1bESuTavfzEVNiYriefdP4Y2DjvY02DzjF7HI2whvM1LHYKtPCrWJ\nqdMHfWfyu99QXG21ZYMjXiYvLaCDTNtmyLQKxWYJk9jT+2imT1hb+mLUwYQip/EU\nbEl4eYbyigL6XhAQt0EuxNVUbddmWDgdO2FyGwv8AQKBgQDEdz9PSnX8jQllNJJ7\nfEeXbPF+xToF2cA6BnOzyk11boFP6LbCONaQLxDOGAM1VegEb6QTSGJeqFTMNEJd\neBaCT0KimjU1YIfIVXbafGbqelWmKfEI5MTvtsNcMKQWm2wJ8/yJ6nDSD7AfXXAb\nE5aHz6KP3XM3x6GbtuaIaHdkgQKBgQC6tT64CMCjoVtzUMA+pzCRIVTOGGDuGhXR\nrXK3A0d3+961VN5JUx8jNr7GTZtalBR5vlTTpjWfLCn4U+jBcUTldIj1IcJcu5ff\nf4jfT/dUk48dEIcPqYpk/ALfTppG5nNVpM9L1aPElUzyifAMOB0qhDi84n3NoyMz\nS2AhJ3lGKwKBgFmKc7tCl4WUDf0nOb+4A7T6/RGm9+vks1x+xkrh3+2ugJcX2/un\nBftOyBz2CrhLP+SNsTzsl5DGrWcoRjrtWWzojNko6Sk7pobilLm9SvaA7Po/UVCZ\nWzxZkq44qQB4s4PRxH5i8Cp85etVnZtpkQiy1Ec3SaTZgklC0czHt+qBAoGAc59U\nFNHOwkZlhLcIJoSQ7f9PLkYomKrswimAddeBBcujcnX5Jj1kdgEsCU/8Gg7D01TL\n4Tn30PefkhocdNb5TINrYSqj25uMhKrND0XNK8IpiV031rouazUpbjKWFbwWxn3G\npfbKcS3oNfa4Akkpvq+dF1PHhnY1kUlnYYC5eHsCgYAHfigJFYzYE6wmLvuc5Hmx\nLvWoi2zskkSYmt3u4pF4tfMvIPTUIhndP4bJ6Al9Myr+zuEVbzPdIPN2rCTg75a2\nXIqzEszby15pCELfwHSISLJ5p5ZFYhpqlMlCG/yehfKWZRBtiA0xzglk8sAl3tdu\nuwfpfOKL6jYo0SXfeLSqDQ==\n-----END PRIVATE KEY-----\n',

            'client_email' => 'firebase-adminsdk-6h2l8@bizooda.iam.gserviceaccount.com',
            'client_id' => '106862047602275359354',
            'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
            'token_uri' => 'https://oauth2.googleapis.com/token',
            'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
            'client_x509_cert_url' => 'https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-6h2l8%40bizooda.iam.gserviceaccount.com',
        ]);

        $factory = (new Factory)->withServiceAccount($serviceAccount);
        $messaging = $factory->createMessaging();

        $message = CloudMessage::withTarget('token', 'your_device_token')
                            ->withNotification(['title' => 'Hello', 'body' => 'World']);

        $response = Firebase::send($message);

        if ($response->isSuccess()) {
            return response()->json([
                "code"=>200,
                "message"=>"Notification sent successfully!"
            ]);
        } else {
            return response()->json([
                "code"=>400,
                "message"=>"Notification could not be sent."
            ])
            ->setStatusCode(400);
        }
    }
}
