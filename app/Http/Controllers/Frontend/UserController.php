<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $orders = Order::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        return view('frontend.profile',compact('orders'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $user = auth()->user();
        $inputs = [
            'name'=>  $request->input('name'),
            'phone'=>  $request->input('phone'),
            'address'=>  $request->input('address'),
        ];
        $user->update($inputs);
        if ($request->file('photo')) {
            if (file_exists('uploads/users/' . $user->photo)) {
                unlink('uploads/users/' . $user->photo);
            }
            $newName = 'user_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->photo->move('uploads/users/', $newName);
            $user->update(['photo' => $newName]);
        }
        return redirect()->back();

    }


    public function register()
    {
        if (auth()->user()){
            if (auth()->user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:3',
        ]);
        $inputs = [
          'name'=>  $request->input('name'),
          'phone'=>  $request->input('phone'),
          'address'=>  $request->input('address'),
          'email'=>  $request->input('email'),
          'role'=>  'customer',
          'password'=>  Hash::make($request->input('password')),
        ];
        User::create($inputs);
        return redirect()->route('login');
    }
}
