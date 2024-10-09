<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Login
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $user = $request->only(['email', 'password']);

        //Xác thực thông tin của user
        if (Auth::attempt($user)) {
            return redirect()->route('admin.posts.index');
        } else {
            return redirect()->back()->with('message', 'Email hoặc Password không chính xác');
        }
    }

    public function getRegister()
    {
        return view('register');
    }
    public function postRegister(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'min:3', 'unique:users'],
            'fullname' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5'],
            'confirm_password' => ['required', 'same:password'],
        ]);

        User::query()->create($data);

        return redirect()->route('login')->with('message', 'Đăng ký tài khoản thành công');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
