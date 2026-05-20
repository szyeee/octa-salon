@extends('layouts.app')

@section('content')

<section class="min-h-screen flex items-center justify-center px-6 py-10 bg-gradient-to-br from-pink-50 via-white to-rose-50">

    <div class="grid lg:grid-cols-2 max-w-6xl w-full overflow-hidden rounded-[2.5rem] shadow-2xl bg-white">

        <div class="hidden lg:flex flex-col justify-center bg-gradient-to-br from-pink-500 via-rose-500 to-fuchsia-500 p-14 text-white relative overflow-hidden">

            <div class="absolute -top-20 -right-20 w-72 h-72 bg-white/10 rounded-full"></div>

            <div class="absolute bottom-0 left-0 w-60 h-60 bg-white/10 rounded-full"></div>

            <div class="relative z-10">

                <span class="bg-white/20 px-5 py-2 rounded-full text-sm backdrop-blur">
                    Octa Salon Premium
                </span>

                <h1 class="mt-8 text-5xl font-extrabold leading-tight">
                    Your Beauty Journey Starts Here
                </h1>

                <p class="mt-6 text-white/90 leading-8">
                    Create your account and enjoy premium salon booking experience with elegant treatments and luxurious services.
                </p>

            </div>

        </div>

        <div class="p-10 lg:p-14">

            <div class="max-w-md mx-auto">

                <h2 class="text-4xl font-extrabold text-slate-800">
                    Create Account
                </h2>

                <p class="mt-3 text-slate-500">
                    Register to start booking salon services.
                </p>

                @if(session('success'))
                    <div class="mt-5 bg-green-100 text-green-700 px-4 py-3 rounded-2xl">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mt-5 bg-red-100 text-red-700 px-4 py-3 rounded-2xl">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="/register" class="mt-8 space-y-5">

                    @csrf

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="nama"
                            placeholder="Enter your full name"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            placeholder="Enter your email"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Enter password"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white">
                    </div>

                    <button
                        class="w-full rounded-2xl bg-gradient-to-r from-pink-500 to-rose-500 py-4 text-lg font-bold text-white shadow-xl shadow-pink-200 transition hover:scale-[1.02]">

                        Register Account

                    </button>

                </form>

                <p class="mt-8 text-center text-slate-500">

                    Already have an account?

                    <a href="/login" class="font-semibold text-pink-600 hover:text-pink-700">
                        Login
                    </a>

                </p>

            </div>

        </div>

    </div>

</section>

@endsection