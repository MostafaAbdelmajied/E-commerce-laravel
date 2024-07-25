<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    public function all() {
        $products = Product::all();
        return ProductResource::collection($products);
    }
    public function show($id){
        $product = Product::find($id);
        if(! $product){
            return response()->json(['msg'=>'product not found'],404);
        }
        return new ProductResource($product);
    }

    public function store(Request $request){
        $isvalid = Validator::make($request->all(),[
            "name"=>"required|string",
            "description"=>"required|string",
            "price"=>"required|numeric",
            "quantity"=>"required|numeric",
            "category_id"=>"required|exists:categories,id",
            "image"=>"mimes:jpeg,jpg,png,PNG,gif"
        ]);
        if($isvalid->fails()){
            return response()->json(["msg"=>$isvalid->errors()],301);
        }
        $image = Storage::putFile("products",$request->image);
        Product::create([
            "name"=>$request->name,
            "description"=>$request->description,
            "price"=>$request->price,
            "quantity"=>$request->quantity,
            "category_id"=>$request->category_id,
            "image"=>$image
        ]);
        return response()->json(["msg"=>"added sucssefully "],201);
    }

    public function edit($id,Request $request){
        $isvalid = Validator::make($request->all(),[
            "name"=>"required|string",
            "description"=>"required|string",
            "price"=>"required|numeric",
            "quantity"=>"required|numeric",
            "category_id"=>"required|exists:categories,id",
            "image"=>"mimes:jpeg,jpg,png,PNG,gif"
        ]);
        if($isvalid->fails()){
            return response()->json(["msg"=>$isvalid->errors()],301);
        }
        $product = Product::find($id);
        if(! $product){
            return response()->json(['msg'=>'product not found'],404);
        }
        $imageName = $product->image;
        if($request->has("image")){
            if($product->image){
                Storage::delete($imageName);
            }
            $imageName = Storage::putFile("products",$request->image);
        }
        // return response()->json(["msg"=>"passed"]);
        $product->update([
            "name"=>$request->name,
            "description"=>$request->description,
            "price"=>$request->price,
            "quantity"=>$request->quantity,
            "category_id"=>$request->category_id,
            "image"=>$imageName
        ]);

        return response()->json(["msg"=>"updated sucssefully",
        "product"=>new ProductResource($product)],201);
    }

    public function delete($id){
        $product = Product::find($id);
        if(! $product){
            return response()->json(["msg"=>"product not found"],404);
        }
        if($product->image){
            Storage::delete($product->image);
        }
        $product->delete($id);
        return response()->json(["msg"=>"deleted successfully"],200);
    }

}
