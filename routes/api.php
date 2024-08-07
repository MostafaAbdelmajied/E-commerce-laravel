<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiProductController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ApiProductController::class)->group(function(){
    Route::middleware("api_auth")->group(function(){

        Route::get("products","all");
        Route::get("products/{id}","show");

        Route::post("products/add","store");

        Route::put("products/edit/{id}","edit");

        Route::delete("products/delete/{id}","delete");
    });
});

Route::controller(ApiAuthController::class)->group(function(){
    Route::post("register","register");
    Route::post("login","login");
    Route::post("logout","logout")->middleware("api_auth");
});