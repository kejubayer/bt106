<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            $creds = $request->except('_token');
//            dd(Auth::attempt($creds));
//            dd(\auth()->attempt($creds));
            if (\auth()->attempt($creds)) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->back();

        } catch (\Exception $exception) {
            $error = $exception->validator->getMessageBag();
            return redirect()->back()->withErrors($error);
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
            return redirect()->route('login');
        }catch (\Exception $exception){
           return redirect()->back();
        }

    }

    public function profile()
    {
        return view('backend.users.profile');
    }
}
