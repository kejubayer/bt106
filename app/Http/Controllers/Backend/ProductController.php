<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        return view('backend.products.create');
    }

    public function store(Request $request)
    {
        $newName = 'product_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
        $request->photo->move('uploads/products/', $newName);

        $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'desc' => $request->input('desc'),
            'photo' => $newName
        ];
        Product::create($data);
        return redirect()->route('admin.product');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('backend.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'desc' => $request->input('desc'),
        ];
        $product->update($data);
        if ($request->file('photo')) {
            if (file_exists('uploads/products/' . $product->photo)) {
                unlink('uploads/products/' . $product->photo);
            }
            $newName = 'product_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->photo->move('uploads/products/', $newName);
            $product->update(['photo' => $newName]);
        }
        return redirect()->route('admin.product');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (file_exists('uploads/products/' . $product->photo)) {
            unlink('uploads/products/' . $product->photo);
        }
        $product->delete();
        return redirect()->back();
    }
}
