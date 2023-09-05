<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        // coba tangkap semua data
        // return request()->all();
        // return $request->all();

        // membuat validasi menggunakan perintah dari laravel validate
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'], //contoh penulisan menggunakan []
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // enkripsi password
        // metode bcrypt
        // $validatedData['password'] = bcrypt($validatedData['password']);
        //metode hash
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        // $request->session()->flash('success', 'Registration successfull! Please Login');

        return redirect('/login')->with('success', 'Registration successfull! Please Login'); // flash bisa langsung dichaininig menggunakan with
    }
}
