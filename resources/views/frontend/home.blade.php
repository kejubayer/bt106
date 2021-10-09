@extends('layouts.frontend')

@section('title')Home - @endsection

@section('main')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Album example</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the
                    creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
                    entirely.</p>
                <p>
                    <a href="{{route('cart')}}" class="btn btn-primary my-2">Show Cart ({{$total_quantity}})</a>
{{--                    <a href="#" class="btn btn-secondary my-2">Secondary action</a>--}}
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($products as $product)
                <div class="col">
                    <div class="card shadow-sm">
{{--                        <img src="{{asset('uploads/products/'.$product->photo)}}" alt="" height="200px">--}}
                        <img src="{{$product->photo}}" alt="" height="200px">

                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('add.cart',$product->id)}}" class="btn btn-sm btn-outline-secondary">Add To Cart</a>
{{--                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>--}}
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

