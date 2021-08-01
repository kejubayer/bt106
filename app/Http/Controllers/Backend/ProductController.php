<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('backend.products.index',compact('products'));
    }

    public function create()
    {
        return view('backend.products.create');
    }

    public function store(Request $request)
    {

        $data = [
            'name'=> $request->input('name'),
            'price'=> $request->input('price'),
            'desc'=> $request->input('desc'),
        ];
        Product::create($data);
        return redirect()->route('admin.product');
    }
}
