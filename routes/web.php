<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("login", [adminController::class, "login"])->name("login");
Route::get("user", [adminController::class, "showAllUsers"])->name("user");
Route::post("savePost", [adminController::class, "submitForm"])->name("savePost");
Route::get("dashboard", [adminController::class, "dashboard"])->name("dashboard");
Route::get("addPost", function () {
    return view("addPost");
});

Route::get("editpost/{id}", [adminController::class, "editpost"])->name("editpost");
Route::get("allpost", [adminController::class, "getAllPost"])->name("allpost");
Route::put("savePostEdit/{id}", [adminController::class, "savePostEdit"])->name("savePostEdit");

Route::get('donate', [adminController::class, 'getDonate'])->name('donate.get');

Route::get('/verify-mail/{token}', [LoginController::class, 'verificationMail']);
Route::get('/reset-password', [LoginController::class, 'resetPasswordLoad']);
Route::post('/reset-password', [LoginController::class, 'resetPassword']);

// send Notification-----
   
Route::get('/push_notification', [NotificationController::class, 'index']);
Route::post('sendNotification', [NotificationController::class, 'sendNotification'])->name('send.notification');

//for strope payment gateway-----
  
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

// payment -----
Route::get('/pay', [PaymentController::class, 'payWithStripe'])->name('pay');

// stripe payment---

Route::post('/create-checkout-session', [\App\Http\Controllers\CheckoutController::class, 'createSession']);
Route::get('/success', function () {
    return view('success');
});
Route::get('/cancel', function () {
    return view('cancel');
});