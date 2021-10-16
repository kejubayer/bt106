<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'All Products',
                    'data' => $products
                ], 200
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage(),
                ], 404
            );
        }
    }

    public function show($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "Not Found",
                    ], 404
                );
            }
            return response()->json(
                [
                    'success' => true,
                    'message' => "Single Product",
                    'data' => $product
                ]
            );

        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage(),
                ], 404
            );
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|min:5|max:255|string|regex:/^[a-zA-Z ]+$/',
                    'price' => 'required',
                    'desc' => 'required',
                    'photo' => 'required|image|max:1024',
                ]
            );
            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "Validation error!",
                        'bugs' => $validator->getMessageBag(),
                    ], 404
                );
            }
            $newName = 'product_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->photo->move('uploads/products/', $newName);
            $data = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'desc' => $request->input('desc'),
                'photo' => $newName
            ];
            $product = Product::create($data);
            return response()->json(
                [
                    'success' => true,
                    'message' => "Product Created!",
                    'data' => $product
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage(),
                ], 404
            );
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|max:255|string',
                    'price' => 'required',
                    'desc' => 'required',
                    'photo' => 'image',
                ]
            );
            if ($validator->fails()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "Validation error!",
                        'bugs' => $validator->getMessageBag(),
                    ], 404
                );
            }

            $product = Product::find($id);
            if (!$product) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "Not Found",
                    ], 404
                );
            }

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

            return response()->json(
                [
                    'success' => true,
                    'message' => "Product Updated!",
                    'data' => $product
                ]
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage(),
                ], 404
            );
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => "Not Found",
                    ], 404
                );
            }
            if (file_exists('uploads/products/' . $product->photo)) {
                unlink('uploads/products/' . $product->photo);
            }
            $product->delete();
            return response()->json(
                [
                    'success' => true,
                    'message' => "Product deleted!",
                ], 200
            );
        }catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage(),
                ], 404
            );
        }
    }
}
