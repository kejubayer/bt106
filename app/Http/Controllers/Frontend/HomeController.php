<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $carts = session()->has('cart') ? session()->get('cart') : [];
        $total_quantity = 0;
        foreach($carts as $cart){
            $total_quantity += $cart['quantity'];
        }
        $products = Product::all();
        return view('frontend.home',compact('products','total_quantity'));
    }
}
