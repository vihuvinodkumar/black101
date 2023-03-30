<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// for user login---
Route::post("saveUser", [LoginController::class, "saveUser"]);
Route::post("userLogin", [LoginController::class, "userLogin"]);
Route::post("saveImage", [LoginController::class, "saveImage"]);
Route::put("updateUser", [LoginController::class, "updateUser"]);
Route::get("checkUserDonation", [LoginController::class, "checkUserDonation"]);
Route::get("sendVerifiedMail/{email}", [LoginController::class, "sendVerifiedMail"]);
