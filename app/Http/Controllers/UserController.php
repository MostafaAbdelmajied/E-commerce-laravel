<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class UserController extends Controller
{
    public function all(){
        $products = Product::paginate(5);
        return view("user.allproducts",compact("products"));
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view("user.show",compact("product"));
    }
    public function search(Request $request){
        $key = $request->key;
        $products = Product::where("name","like","%$key%")->get();
        return view("user.search",compact("products"));
    }

    public function addToCart(Request $request,Product $product){
        // dd(session('cart'));
        if(! session()->has('cart')){
            session()->put('cart',[]);
        }
        $cart = session()->get('cart');

        if (isset($cart[$product->id])){
            $cart[$product->id]['quantity'] += (int) $request->input('quantity');
        }else{
            $cart[$product->id] = [
                'name'=>$product->name,
                'desc'=>substr($product->description,0,50),
                'price'=>$product->price,
                'image'=>$product->image,
                'quantity'=>(int) $request->input('quantity')
            ];
        }

        session()->put('cart',$cart);
        return redirect()->back();
        // dd(session('cart'));
    }

    public function cart(){
        $cart = session('cart');
        // dd($cart);
        return view('user.mycart',['cart'=>$cart]);
    }

    public function delete ($id){
        $cart = session('cart');
        unset($cart[$id]);
        session()->put('cart',$cart);
        return redirect()->back();
    }

    public function makeOrder(Request $request){
        $day = $request->input('day');
        $products = session()->get('cart');
        $total = 0;
        if(empty($products)){
            return redirect()->back();
        }
        foreach($products as $product){
            $total += $product['quantity'] * $product['price'];
        }

        $order = [
            'user_id'=>Auth::user()->id,
            'requiredDtae'=>$day,
            'totalPrice'=>$total
        ];

        $order = Order::create($order);

        foreach($products as $id=>$product){
            OrderDetails::create([
                'order_id'=>$order->id,
                'product_id'=>$id,
                'quantity'=>$product['quantity'],
                'price'=>$product['price']
            ]);
        }
        return redirect('/redirect');
    }
}
