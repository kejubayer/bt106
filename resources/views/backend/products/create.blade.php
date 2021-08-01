@extends('layouts.backend')

@section('main')

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2 class="text-center">Create Product</h2>
                <form action="{{route('admin.product.create')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Product Description</label>
                        <textarea class="form-control" name="desc" id="desc" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
