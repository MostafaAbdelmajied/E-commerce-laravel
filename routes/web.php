<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get("/redirect",[HomeController::class,"redirect"])->name("redirect")->middleware("auth");

Route::controller(ProductController::class)->group(function(){

    Route::middleware("auth","is_admin")->group(function(){

        Route::get("aa/products","all");
        Route::get("aa/products/show/{id}","show");

        Route::get("aa/products/create","create");
        Route::post("aa/products/store","store");

        Route::get("aa/products/edit/{id}","edit");
        Route::post("aa/products/update/{id}","update");

        Route::post("aa/products/delete/{id}","delete");
    });
    });


Route::get("change/{lang}",function($lang){
    session()->put("lang",$lang);
    return redirect()->back();
});

Route::controller(UserController::class)->group(function(){
    Route::get("products","all");
    Route::get("products/{id}","show");
    Route::get("search","search");
    Route::post("addtocart/{product}",'addToCart');
    Route::get('cart',"cart");
    Route::delete('cart/{id}','delete');
    Route::post("/makeorder",'makeOrder');
});

//Route::get("admin/products","ProductController@all");

Route::get("predict",[TestController::class,"predict"]);