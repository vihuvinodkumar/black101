<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class CheckoutController extends Controller
{
    /**
     * Create a new Checkout Session.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiErrorException
     */
    public function createSession(Request $request)
    {
        // Set your Stripe API secret key.
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        // Create the Checkout Session.
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'inr',
                        'unit_amount' => 1000,
                        'product_data' => [
                            'name' => 'Example Product',
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => url('/success'),
            'cancel_url' => url('/cancel'),
        ]);

        return response()->json(['sessionId' => $session['id']]);
    }
}