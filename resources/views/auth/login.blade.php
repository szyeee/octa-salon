@extends('layouts.app')

@section('content')

<section class="min-h-screen flex items-center justify-center px-6 py-10 bg-gradient-to-br from-pink-50 via-white to-rose-50">

    <div class="grid lg:grid-cols-2 max-w-6xl w-full overflow-hidden rounded-[2.5rem] shadow-2xl bg-white">

        <div class="hidden lg:flex flex-col justify-center bg-gradient-to-br from-pink-500 via-rose-500 to-fuchsia-500 p-14 text-white relative overflow-hidden">

            <div class="absolute top-0 right-0 w-80 h-80 bg-white/10 rounded-full"></div>

            <div class="absolute bottom-0 left-0 w-72 h-72 bg-white/10 rounded-full"></div>

            <div class="relative z-10">

                <span class="bg-white/20 px-5 py-2 rounded-full text-sm backdrop-blur">
                    Luxury Salon Experience
                </span>

                <h1 class="mt-8 text-5xl font-extrabold leading-tight">
                    Welcome Back Beautiful ✨
                </h1>

                <p class="mt-6 text-white/90 leading-8">
                    Login to continue booking premium beauty treatments and manage your appointments easily.
                </p>

            </div>

        </div>

        <div class="p-10 lg:p-14">

            <div class="max-w-md mx-auto">

                <h2 class="text-4xl font-extrabold text-slate-800">
                    Login
                </h2>

                <p class="mt-3 text-slate-500">
                    Sign in to your salon account.
                </p>

                @if(session('error'))
                    <div class="mt-5 bg-red-100 text-red-700 px-4 py-3 rounded-2xl">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="/login" class="mt-8 space-y-5">

                    @csrf

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
                            placeholder="Enter your password"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white">

                    </div>

                    <button
                        class="w-full rounded-2xl bg-gradient-to-r from-pink-500 to-rose-500 py-4 text-lg font-bold text-white shadow-xl shadow-pink-200 transition hover:scale-[1.02]">

                        Login

                    </button>

                </form>

                <p class="mt-8 text-center text-slate-500">

                    Don't have an account?

                    <a href="/register" class="font-semibold text-pink-600 hover:text-pink-700">
                        Register
                    </a>

                </p>

            </div>

        </div>

    </div>

</section>

@endsection