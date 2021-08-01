@extends('layouts.backend')

@section('main')

    <div class="container mt-3">
        <h2 class="text-center">Products List</h2>
        <a href="{{route('admin.product.create')}}" class="btn btn-success">Create new product</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">1</th>
                    <td>{{$product->name}}</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
