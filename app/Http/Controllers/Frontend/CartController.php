<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
        public function cart($id)
    {
        $product = Product::find($id);
        $cart = session()->has('cart') ? session()->get('cart') : [];
        /*  if (session()->has('cart')){
              $cart = session()->get('cart');
          }else{
              $cart = [];
          }*/

        if (key_exists($product->id,$cart)){
              $cart[$product->id]['quantity'] = $cart[$product->id]['quantity']+1;
        }else{
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }
        session(['cart' => $cart]);
        Session::flash('message','Product Added To Cart!');
        Session::flash('alert','success');
        return redirect()->back();
    }

    public function show()
    {
        $carts = session()->has('cart') ? session()->get('cart') : [];
        return view('frontend.cart',compact('carts'));
    }
}
