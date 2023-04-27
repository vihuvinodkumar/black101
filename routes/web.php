<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
    
    use App\Http\Controllers\NotificationSendController;

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
Route::post("dashboard", function () {
    return view('dashboard');
});
Route::get("addPost", function () {
    return view("addPost");
});

Route::get("editpost/{id}", [adminController::class, "editpost"])->name("editpost");
Route::get("allpost", [adminController::class, "getAllPost"])->name("allpost");
Route::put("savePostEdit/{id}", [adminController::class, "savePostEdit"])->name("savePostEdit");

Route::get('/verify-mail/{token}', [LoginController::class, 'verificationMail']);
Route::get('/reset-password', [LoginController::class, 'resetPasswordLoad']);
Route::post('/reset-password', [LoginController::class, 'resetPassword']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'],function(){
    Route::post('/store-token', [NotificationSendController::class, 'updateDeviceToken'])->name('store.token');
    Route::post('/send-web-notification', [NotificationSendController::class, 'sendNotification'])->name('send.web-notification');
});
