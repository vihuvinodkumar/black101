<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\PostDetailController;
use App\Http\Controllers\DashboardController;

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
Route::post("forgetPassword", [LoginController::class, "forgetPassword"]);

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
Route::get("getPostByUserId", [StoryController::class, "getPostByUserId"]);

// for rating-----
Route::post("addRating", [RatingController::class, "addRating"]);
Route::get("getAllRating", [RatingController::class, "getAllRating"]);
Route::get("getAllRatingByProductId/{product_id}", [RatingController::class, "getAllRatingByProductId"]);
Route::put("updateRating/{id}", [RatingController::class, "updateRating"]);
Route::get("getAllRatingByProductId/{product_id}", [RatingController::class, "getAllRatingByProductId"]);
Route::post("add_like", [RatingController::class, "add_like"]);
Route::delete("dislike/{id}", [RatingController::class, "dislike"]);


// post details -------
Route::get('getFullPostDetails', [PostDetailController::class, 'getFullPostDetails']);


// Dashboard-------
Route::get('getDashboard', [DashboardController::class, 'getDashboard']);

