<?php

use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\SubscriberController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// websites
Route::group(["prefix" => "websites"], function () {

    Route::get("/", [WebsiteController::class, "index"]);
    Route::post("/", [WebsiteController::class, "store"]);
});

// posts
Route::group(["prefix" => "posts"], function () {

    Route::get("/", [PostController::class, "index"]);
    Route::post("/", [PostController::class, "store"]);
});

// users
Route::group(["prefix" => "users"], function () {

    Route::get("/", [UserController::class, "index"]);
    Route::post("/", [UserController::class, "store"]);
});

// subscribers
Route::post("/subscribe", [SubscriberController::class, "subscribe"]);
