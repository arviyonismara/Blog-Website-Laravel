<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        // kirim juga data dalam bentuk array
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        // validasi email dan password
        $credentials = $request->validate([
            // 'email' => 'required|email:dns',
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        // autentikasi agar
        if (Auth::attempt($credentials)) { //attempt akan memberikan nilai true jika benar
            $request->session()->regenerate(); //meregenerate session untuk mengindari user nakal menggunakan session yang sama

            return redirect()->intended('/dashboard'); ///intended supaya melalui middleware
        }

        return back()->with('loginError', 'Login failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
