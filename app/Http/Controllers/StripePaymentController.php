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
    Stripe\Stripe::setApiKey('sk_test_51N7V4CD0tzja3zlTmYDbCgBgOZlh66z5OUxM27QrsP1YC5HlWH1OHsLQ6oSQ82QncVACkmN1ZP09wd1wHKN2DdPr004FytFYg9');

    $stripeToken = $request->stripeToken;
    $paymentMethod = Stripe\PaymentMethod::create([
        "type" => "card",
        "card" => [
            "token" => $stripeToken,
        ],
    ]);

    $customer = Stripe\Customer::create([
        "address" => [
            "line1" => "123 Main St",
            "postal_code" => "94111",
            "city" => "San Francisco",
            "state" => "CA",
            "country" => "US",
        ],
        "email" => "demo@gmail.com",
        "name" => "Nitin Pujari",
        "payment_method" => $paymentMethod->id,
    ]);

    $paymentIntent = Stripe\PaymentIntent::create([
        "amount" => 100 * 100,
        "currency" => "usd",
        "customer" => $customer->id,
        "description" => "Test payment from LaravelTus.com.",
        "payment_method_types" => ["card"],
        "payment_method" => $paymentMethod->id,
        "shipping" => [
            "name" => "Jenny Rosen",
            "address" => [
                "line1" => "510 Townsend St",
                "postal_code" => "98140",
                "city" => "San Francisco",
                "state" => "CA",
                "country" => "US",
            ],
        ],
    ]);

    $paymentIntent->confirm();

    Session::flash('success', 'Payment successful!');
    return back();
}

}
