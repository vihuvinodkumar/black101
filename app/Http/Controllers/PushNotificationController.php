<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\Notification;




class PushNotificationController extends Controller
{
    public function pushNotification(Request $request)
    {
        
        $serviceAccount = ServiceAccount::fromValue([
            'type' => 'service_account',
            'project_id' => 'black101-add3e',
            'private_key_id' => 'bd9603f32e431c4f874d79176aad83157b6956fc',

            'private_key' => '-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCrR5kUPNrh7djP\nWVlm+L/gV2xog9QlsJ2aL0JE5Kf5b+c8ERFhmLcOJPlahk+QAxMynmDtnRMCHYLK\nB+kOZQg8hGeZSRCYeC1wnZbq3aJJ9Oy+x5QjsGS0kuknOZhvYa4hMJIK+Xsa80SP\nj9GavGWlbSD4B5gjLQTJ8jDBc/D/q69uCcd+yuiR3OqXh19ZfsCWTzeWTVUzcdUM\nltxQhhKy976JlQaBKXWb0O0S8IcIsJLfY9iS4v/Wdusqxrv2V5BI0bVbi/6QtEaS\njKgGYOsbl+HhgKMve5dV7wfEbTCIBCcj6aeXcp7Ma3xtmf4cD2W1tMzyURJMpS8y\ndQl8CHlbAgMBAAECggEASBAULmkaOINfPIIdtM7EwAlYQbLxb7ga3xOyIJVJvQ9h\nbSrLMtJTdl6FERrAX9mDWsE7C84SAMpUzFa+rgFBEWEty1br5hJuH9sV85QzY0Vq\n1CvZPpjJDhZfhVLcuUQSRMGQOJDVxDWE65f5es54P70l6WUck/Qtdx/wdnwm8hJk\nOI0GSIBeHutivQsDmZE0tQ6+AnSw0DHAR93fNSZ2QEt5XTd3MI+OEhKRoNsijhsq\nmXozTnVLhWGcS6NSF1Tf/eHY1qhnHExpMsvQXwtbUJsH+UoEqnKE8HgA1ZYo4y7t\nlO7ht5jO/Ku/xt1TvGU8KH8GfmsvVoaDdSVKq/69hQKBgQDWchl+YWNpEFfaJnVj\nLxyo+BWoI2yuZuoKB2MBx+KSeoKtRddxZbVhoBhlIIanbOWezftl3GU/x6lSUFDz\nS6l0Idm0mVUzi57vPxCX8c9iDdxWhuaxfcC5iT96uCXPIASrBNBVwu+MReRlPiSO\n1IncYY10/zvRkv/k76lVpDBW1QKBgQDMeC7kGghex+UAd/+lshkPQVAbSWOOryGV\nKnC8DtKfxoEvxC5KMAGtDU3PoaugI5ZS1M6GrV5T6bYRr5fwRtP6P5B2cQLyeLWk\nuin5bZMiMYjBBMlvASQrct7Emq+OEdikQQm07RGUoYKgFLukNiyaE05S3L5OzraL\niYVhZWcHbwKBgGEvgphBALGLw5TNGyQhJMb6762sqEN9xpFW+arD8M3bkb9/SH1O\nz933lTa3f+7+ri3DQizOrmAyV21DkvxADQLhmG19lBxxKU1Z8mY6I3dXusTIDGLi\nD+bF6avvKstswlDTNKu5VaDnx/OOLzk/316uI1KjnXOEQE57wu1aJMIlAoGAHCg8\nxNq05mB+r7bWtLm267vhzTApDqAdbs4+Yhdkd+49IhfRDBRaVrtrSLmJye68p8F4\ng2FiiQm5MexNbyBB1sdkHHtpnXxz/zBH0Xp+dYn+vB3to2Sz12vlM4vduyHIBK6U\nKJ8w+ZfYRjU0teNj9v/LnGubpXyf9M1GWeg97O8CgYB6hhIDkQlPoPPxFQISKykt\nnEzAMLNUunyJwHketHgxb8o8iB9+2tn66HOCZk10IAw3xmyq6KNOxrzxFIVd0WQD\nJ+lWN29uOmqgV4cSZBqwz3c/Du4qhfMG/qoFXAtivZDtwGh1DRDY6H775xkgR4Ba\nF1PMeVU98ngC2hKD7vO+8g==\n-----END PRIVATE KEY-----\n',

            'client_email' => 'firebase-adminsdk-1otec@black101-add3e.iam.gserviceaccount.com',
            'client_id' => '110559474196495152683',
            'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
            'token_uri' => 'https://oauth2.googleapis.com/token',
            'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
            'client_x509_cert_url' => 'https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-1otec%40black101-add3e.iam.gserviceaccount.com',
        ]);

        $factory = (new Factory)->withServiceAccount($serviceAccount);
        $messaging = $factory->createMessaging();

        $message = CloudMessage::withTarget('token', 'your_device_token')
                            ->withNotification(Notification::create('Hello', 'World'));

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
