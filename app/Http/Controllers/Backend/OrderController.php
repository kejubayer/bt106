<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id','desc')->paginate(10);
        return view('backend.orders.index',compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id',$id)->with('details')->first();
        return view('backend.orders.show',compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update(['status'=>$request->input('status')]);
        return redirect()->back();
    }

    public function processing()
    {
        $status="Processing";
        $orders = Order::orderBy('id','desc')->where('status','Processing')->paginate(10);
        return view('backend.orders.status',compact('orders','status'));
    }
    public function pending()
    {
        $status="Pending";
        $orders = Order::orderBy('id','desc')->where('status','Pending')->paginate(10);
        return view('backend.orders.status',compact('orders','status'));
    }
}
