<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // login admin
    public function showAdmin()
    {
        return view('login.admin');
    }

    public function processAdmin(Request $request)
    {
        // validasi input
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // authentifikasi
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();            
            return redirect()->route('admin.dashboard')->with('success','Login Admin Berhasil!');
        }

        // gagal
        return back()->withErrors(['email' => 'Kredensial Admin tidak valid.'])->withInput();
    }
    public function logout(Request $request) {
    Auth::logout();
    return redirect('/login/admin');
}
}