<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ]);

        return redirect('/login')
            ->with('success', 'Register berhasil');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only(
            'email',
            'password'
        );

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/');

        }

        return back()->with(
            'error',
            'Email atau password salah'
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email'
        ]);

        $user = Auth::user();

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email
        ]);

        return back()->with(
            'success',
            'Profile berhasil diperbarui'
        );
    }
}