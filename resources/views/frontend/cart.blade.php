@extends('layouts.frontend')

@section('main')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3 class="text-center">Your Cart</h3>
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
                @php
                $total_quantity = 0;
                $total_price = 0;
                @endphp

                @foreach($carts as $key=>$cart)
                    <tr>
                        <td>{{$cart['name']}}</td>
                        <td>{{$cart['price']}} ৳</td>
                        <td>{{$cart['quantity']}}</td>
                        <td>{{$cart['quantity'] * $cart['price']}} ৳</td>
                    </tr>

                    @php
                        $total_quantity += $cart['quantity'];
                        $total_price += $cart['quantity'] * $cart['price'];
                    @endphp
                @endforeach

                <tr>
                    <td></td>
                    <th>Total</th>
                    <td>{{$total_quantity}}</td>
                    <td>{{$total_price}} ৳</td>
                </tr>

                </tbody>
            </table>
            @if($total_quantity == 0)
                <div class="btn-warning">
                    <p>No Product added to cart! Please add <a href="{{route('home')}}">product</a> to cart</p>
                </div>
            @else
                <a href="{{route('checkout')}}" class="btn btn-success">Checkout</a>
            @endif
        </div>
    </div>

@endsection
