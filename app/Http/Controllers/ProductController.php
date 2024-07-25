<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Livewire\store;

class ProductController extends Controller
{
    public function all(){
        $products = Product::paginate(5);
        return view("admin.allproducts",compact("products"));
    }

    public function show($id){

        $product = Product::findOrFail($id);

        return view("admin.show",compact("product"));
    }

    public function create(){
        $categories = Category::all();
        return view("admin.create",compact("categories"));
    }
    public function store(Request $request){
        $data = $request->validate([
            "name"=>"required|string",
            "description"=>"required|string",
            "price"=>"required|numeric",
            "quantity"=>"required|numeric",
            "category_id"=>"required|exists:categories,id",
            "image"=>"mimes:jpeg,jpg,png,PNG,gif"
        ]);
        if($request->has("image")){
            $data['image'] = Storage::putFile("products",$data['image']);
        }
        Product::create($data);
        session()->flash("success","prouduct added successfully");
        return redirect(url("products"));
    }

    public function delete($id){
        $product = Product::findOrFail($id);
        if(! is_null($product->image))  Storage::delete($product->image) ;
        $product->delete();
        return redirect(url("products"));
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view("admin.edit",compact("product","categories"));
    }
    public function update($id,Request $request){
        $product = Product::findOrFail($id);
        $data = $request->validate([
            "name"=>"required|string",
            "description"=>"required|string",
            "price"=>"required|numeric",
            "quantity"=>"required|numeric",
            "category_id"=>"required|exists:categories,id",
            "image"=>"mimes:jpeg,jpg,png,PNG,gif"
        ]);
        if($request->has("image")){
            Storage::delete($product->image);
            $data['image']=Storage::putFile("products",$data['image']);
        }
        $product->update($data);
        return redirect(url("products"));
    }
}
