<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){
        if(Auth::user()->role == "admin"){
            return view("admin.home");
        }else{
            $products = Product::paginate(5);
            return view("user.home",compact("products"));
        }

    }
}
