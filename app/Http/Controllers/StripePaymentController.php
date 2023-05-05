<?php
    
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use Session;
use Stripe;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
    
    /**
 * success response method.
 *
 * @return \Illuminate\Http\Response
 */
public function stripePost(Request $request)
{
    // print_r($request->all()); die();
    Stripe\Stripe::setApiKey('sk_test_51MyqNkSIrVUMjLi4llXBuKnp2qbiAzZNwbc5NV4rr7p1YEXi4Nwekwj7fy3l02k6ZTiv53tI2A07nVDBbRk4ZVVF00ZnSZ9kvU');
    $customer = Stripe\Customer::create(array(
            "address" => [
                "line1" => "123 Main St",
                "postal_code" => "94111",
                "city" => "San Francisco",
                "state" => "CA",
                "country" => "US",
            ],
            "email" => "demo@gmail.com",
            "name" => "Nitin Pujari",
            "source" => $request->stripeToken
        ));

    Stripe\Charge::create ([
            "amount" => 100 * 100,
            "currency" => "usd",
            "customer" => $customer->id,
            "description" => "Test payment from LaravelTus.com.",
            "shipping" => [
                "name" => "Jenny Rosen",
                "address" => [
                    "line1" => "510 Townsend St",
                    "postal_code" => "98140",
                    "city" => "San Francisco",
                    "state" => "CA",
                    "country" => "US",
                ],
            ]
    ]); 
    Session::flash('success', 'Payment successful!');
    return back();
}

    
}