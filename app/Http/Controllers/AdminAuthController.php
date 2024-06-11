<?php

namespace App\Http\Controllers;

use App\Models\AdminAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    ///register
    public function register()
    {
        if(request()->isMethod('post'))
        {
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:7',
                'confirm_password' => 'required|same:password|min:7',
            ]);

            AdminAuth::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),

            ]);
            return to_route('login');
        }
        return view('backend.Admin.registration');
    }
    ///login
    public function login()
    {

        if(request()->isMethod('post')){
            $this->validate(request(), [
                'email' => 'required|email',
                'password' => 'required|min:7'
            ]);

            if (Auth::guard('admin')->attempt([
                'email' => request('email'),
                'password' => request('password'),
            ])) {
                return to_route('admin.dashboard');
            } else {
                return 'credential not matched';
            }
        }
        return view('backend.Admin.login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return to_route('login');
    }
}
