@extends('layouts.frontend')

@section('main')

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h3 class="text-center">Order Details</h3>
                <p><strong>Order No : </strong>{{$order->truck_no}}</p>
                <p><strong>Customer Name: </strong>{{$order->name}}</p>
                <p><strong>Customer email: </strong>{{$order->email}}</p>
                <p><strong>Customer address: </strong>{{$order->address}}</p>
                <p><strong>Customer phone: </strong>{{$order->phone}}</p>
                <p><strong>Total Price: </strong>{{$order->price}}</p>
                <p><strong>Total quantity: </strong>{{$order->quantity}}</p>
                <p><strong>Total status: </strong>{{$order->status}}</p>
                <p><strong>Payment Method: </strong>{{$order->payment_method}}</p>
                <p><strong>Txn Id: </strong>{{$order->txn_id}}</p>
                <p><strong>Date: </strong>{{$order->created_at->format('y-m-d')}}</p>

            </div>
            <div class="col-md-6">
                <h3 class="text-center">Product Details</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->details as $key=>$details)
                        <tr>
                            <td>{{$details->product_name}}</td>
                            <td>{{$details->product_price}}</td>
                            <td>{{$details->quantity}}</td>
                            <td>{{$details->quantity * $details->product_price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
