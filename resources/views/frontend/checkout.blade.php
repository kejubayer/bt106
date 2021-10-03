@extends('layouts.frontend')

@section('main')
    <div class="container">
        <div class="row mt-3">
            <h3 class="text-center">Please Checkout</h3>
            <div class="col-md-6">
                <h3 class="text-center">Cart Info</h3>
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
            </div>
            <div class="col-md-6">
                <h3 class="text-center">User Info</h3>
                <form action="{{route('order')}}" method="post">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{auth()->user()->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{auth()->user()->phone}}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control">{{auth()->user()->address}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" >Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{auth()->user()->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label" >Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                            <option value="Bkash">Bkash</option>
                            <option value="Rocket">Rocket</option>
                            <option value="Nagod">Nagod</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="txn_id" class="form-label" >Txn Id</label>
                        <input type="text" name="txn_id" class="form-control" id="txn_id">
                    </div>

                    <input type="hidden" name="price" value="{{$total_price}}">
                    <input type="hidden" name="quantity" value="{{$total_quantity}}">

                    <button type="submit" class="btn btn-primary">Place Order</button>
                </form>
            </div>
        </div>
    </div>


@endsection
