<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password as PasswordFacade; 
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRules; 
use Illuminate\Auth\Events\Registered; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'confirmed', 
                PasswordRules::min(6), 
            ]
        ]);

        // Simpan data user ke database
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer'
        ]);

        // TRIGGER SISTEM: Laravel otomatis mengirimkan email verifikasi ke email pendaftar
        event(new Registered($user));

        // Otomatis buat user berstatus login setelah register
        Auth::login($user);

        // Lempar ke halaman pemberitahuan verifikasi email bawaan laravel
        return redirect('/email/verify')
            ->with('success', 'Registrasi sukses! Silakan periksa kotak masuk email kamu untuk verifikasi.');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only(
            'email',
            'password'
        );

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/home');

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
            'email' => 'required|email',
            'nomor_telepon' => 'nullable|string|max:20'
        ]);

        $user = Auth::user();

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon
        ]);

        return back()->with(
            'success',
            'Profile berhasil diperbarui'
        );
    }

    // Fungsi forgot password
    public function showForgotPasswordForm()
    {
        return view('auth.forgotPassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = PasswordFacade::sendResetLink(
            $request->only('email')
        );

        return $status === PasswordFacade::RESET_LINK_SENT
            ? back()->with(['success' => 'Link reset password telah dikirim ke email Anda.'])
            : back()->withErrors(['email' => 'Gagal mengirim link reset password.']);
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            
            'password' => [
                'required',
                'confirmed',
                PasswordRules::min(6),
            ],
        ]);

        $status = PasswordFacade::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === PasswordFacade::PASSWORD_RESET) {
            return redirect('/login')->with('success', 'Password kamu berhasil direset! Silakan login.');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}