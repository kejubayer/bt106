<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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

        if (key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity'] = $cart[$product->id]['quantity'] + 1;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }
        session(['cart' => $cart]);
        Session::flash('message', 'Product Added To Cart!');
        Session::flash('alert', 'success');
        return redirect()->back();
    }

    public function show()
    {
        $carts = session()->has('cart') ? session()->get('cart') : [];
        return view('frontend.cart', compact('carts'));
    }

    public function checkout()
    {
        $carts = session()->has('cart') ? session()->get('cart') : [];
        return view('frontend.checkout', compact('carts'));
    }

    public function order(Request $request)
    {
//        dd($request->all());
        $inputs = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'payment_method' => $request->input('payment_method'),
            'txn_id' => $request->input('txn_id'),
            'truck_no' => 'hr'.auth()->user()->id.time(),
            'user_id' => auth()->user()->id,
            'status' => 'Pending'
        ];
        $carts = session()->has('cart') ? session()->get('cart') : [];
        $order = Order::create($inputs);
        foreach ($carts as $cart){
            OrderDetail::create([
                'order_id'=>$order->id,
                'product_id'=>$cart['product_id'],
                'product_name'=>$cart['name'],
                'product_price'=>$cart['price'],
                'quantity'=>$cart['quantity'],
            ]);
        }
        \session()->forget('cart');
        Mail::to(auth()->user()->email)->send(new OrderMail($order));
        return redirect()->route('user.profile');
    }

    public function orderShow($id)
    {
        $order = Order::find($id);
        return view('frontend.order',compact('order'));
    }


}
