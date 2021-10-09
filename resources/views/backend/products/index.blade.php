@extends('layouts.backend')

@section('main')

    <div class="container mt-3">
        <h2 class="text-center">Products List</h2>
        <a href="{{route('admin.product.create')}}" class="btn btn-success mb-3">Create new product</a>
        <table class="table display" id="productData">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Photo</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $key=>$product)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}} BDT</td>
                    <td>{{$product->desc}}</td>
                    <td>
                        <img src="{{asset('uploads/products/'.$product->photo)}}" alt="" height="50px">
                    </td>
                    <td>
                        <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-primary">Edit</a>
                        <a href="{{route('admin.product.delete',$product->id)}}" class="btn btn-warning">Delete</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#productData').DataTable();
        } );
    </script>
@endsection




