<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\StoryController;

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
Route::get("sendVerifiedMail", [LoginController::class, "sendVerifiedMail"]);

// for donate----
Route::post("createDonate", [DonateController::class, "createDonate"]);
Route::get("getAllDonate", [DonateController::class, "getAllDonate"]);
Route::get("getDonateById/{id}", [DonateController::class, "getDonateById"]);
Route::delete("deleteDonate/{id}", [DonateController::class, "deleteDonate"]);
Route::put("updateDonate/{id}", [DonateController::class, "updateDonate"]);

// for story-----
Route::post("createStory", [StoryController::class, "createStory"]);
Route::get("getAllStory", [StoryController::class, "getAllStory"]);
Route::get("getStoryById/{id}", [StoryController::class, "getStoryById"]);
Route::delete("deleteStory/{id}", [StoryController::class, "deleteStory"]);
Route::put("updateStory/{id}", [StoryController::class, "updateStory"]);

