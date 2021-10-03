@extends('layouts.frontend')

@section('main')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h3 class="text-center">Profile</h3>
                <img src="{{asset('uploads/users/'.auth()->user()->photo)}}" alt="photo" height="150px" class="m-3">
                <form action="{{route('user.profile')}}" method="post" enctype="multipart/form-data">
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
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{auth()->user()->email}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control" id="photo">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2 class="text-center">Order List</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order No</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key=>$order)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$order->truck_no}}</td>
                            <td>{{$order->price}}</td>
                            <td>
                                <p class="btn btn-success">
                                    {{$order->created_at->format('Y-m-d')}}
                                </p>
                            </td>
                            <td>{{$order->status}}</td>
                            <td>
                                <a href="{{route('order.show',$order->id)}}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
