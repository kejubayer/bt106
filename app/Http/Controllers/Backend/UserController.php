<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|confirmed|min:3',
            ]);
            $inputs = [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'admin',
            ];

            User::create($inputs);
            return redirect()->route('admin.user');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            $error = $exception->validator->getMessageBag();
            return redirect()->back()->withErrors($error)->withInput();
        }
    }
}
