<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
if (Auth::attempt($request->only('email', 'password'))) {
    $request->session()->regenerate();

    session()->put('login_success', 
        Auth::user()->role === 'admin'
            ? 'Berhasil login sebagai Admin'
            : 'Berhasil login sebagai Kasir'
    );

    return redirect('/dashboard');
}



        return back()->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Berhasil logout');
    }
}
