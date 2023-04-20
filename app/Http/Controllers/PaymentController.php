<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    
public function payWithStripe()
{
    Stripe::setApiKey('sk_test_51MyqNkSIrVUMjLi4llXBuKnp2qbiAzZNwbc5NV4rr7p1YEXi4Nwekwj7fy3l02k6ZTiv53tI2A07nVDBbRk4ZVVF00ZnSZ9kvU');

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
            [
                'name' => 'Product Name',
                'description' => 'Product Description',
                'amount' => 1000,
                'currency' => 'usd',
                'quantity' => 1,
            ],
        ],
        'success_url' => 'http://example.com/success',
        'cancel_url' => 'http://example.com/cancel',
    ]);

    return redirect()->to($session->url);
}
}
