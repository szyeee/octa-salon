@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center px-6 py-10 bg-gradient-to-br from-pink-50 via-white to-rose-50">

    <div class="max-w-md w-full overflow-hidden rounded-[2.5rem] shadow-2xl bg-white p-10 lg:p-14">
        
        <h2 class="text-3xl font-extrabold text-slate-800">New Password</h2>
        <p class="mt-3 text-slate-500 text-sm">Please enter your new password below.</p>

        @if($errors->any())
            <div class="mt-5 bg-red-100 text-red-700 px-4 py-3 rounded-2xl text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-700">New Password</label>
                <input type="password" name="password" required placeholder="Min 6 characters"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-700">Confirm New Password</label>
                <input type="password" name="password_confirmation" required placeholder="Repeat your password"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white">
            </div>

            <button class="w-full rounded-2xl bg-gradient-to-r from-pink-500 to-rose-500 py-4 font-bold text-white shadow-xl shadow-pink-200 transition hover:scale-[1.02]">
                Reset Password
            </button>
        </form>

    </div>

</section>
@endsection
