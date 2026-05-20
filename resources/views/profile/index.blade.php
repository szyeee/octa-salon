@extends('layouts.app')

@section('content')

<section class="max-w-5xl mx-auto px-6 py-12">

    <div class="overflow-hidden rounded-[2.5rem] bg-white shadow-2xl border border-pink-100">

        <div class="relative overflow-hidden bg-gradient-to-r from-pink-500 via-rose-500 to-fuchsia-500 p-12 text-white">

            <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full"></div>

            <div class="absolute bottom-0 left-0 w-72 h-72 bg-white/10 rounded-full"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center gap-6">

                <div class="w-28 h-28 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-5xl font-extrabold">

                    {{ strtoupper(substr(Auth::user()->nama,0,1)) }}

                </div>

                <div>

                    <h1 class="text-5xl font-extrabold">

                        {{ Auth::user()->nama }}

                    </h1>

                    <p class="mt-3 text-lg text-white/90">

                        {{ Auth::user()->email }}

                    </p>

                    <div class="mt-4 inline-flex rounded-full bg-white/20 px-5 py-2 text-sm backdrop-blur">

                        @if(Auth::user()->is_admin)
                            Official Admin Octa
                        @else
                            Premium Salon Member
                        @endif

                    </div>

                </div>

            </div>

        </div>

        <div class="p-10">

            <div>

                <h2 class="text-3xl font-bold text-slate-800">

                    Edit Profile

                </h2>

                <p class="mt-2 text-slate-500">

                    Update your salon account information.

                </p>

            </div>

            @if(session('success'))

                <div class="mt-6 rounded-2xl bg-green-100 px-5 py-4 text-green-700">

                    {{ session('success') }}

                </div>

            @endif

            @if($errors->any())

                <div class="mt-6 rounded-2xl bg-red-100 px-5 py-4 text-red-700">

                    {{ $errors->first() }}

                </div>

            @endif

            <form
                method="POST"
                action="/profile/update"
                class="mt-10 space-y-7">

                @csrf

                <div>

                    <label class="block mb-3 text-sm font-semibold text-slate-700">

                        Full Name

                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ Auth::user()->nama }}"
                        class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-6 py-5 text-lg outline-none focus:border-pink-400 focus:bg-white">

                </div>

                <div>

                    <label class="block mb-3 text-sm font-semibold text-slate-700">

                        Email Address

                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ Auth::user()->email }}"
                        class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-6 py-5 text-lg outline-none focus:border-pink-400 focus:bg-white">

                </div>

                <div>

                    <label class="block mb-3 text-sm font-semibold text-slate-700">

                        Phone Number

                    </label>

                    <input
                        type="text"
                        name="nomor_telepon"
                        value="{{ Auth::user()->nomor_telepon }}"
                        class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-6 py-5 text-lg outline-none focus:border-pink-400 focus:bg-white">

                </div>

                <button
                    class="rounded-3xl bg-gradient-to-r from-pink-500 to-rose-500 px-10 py-5 text-lg font-bold text-white shadow-xl shadow-pink-200 transition hover:scale-[1.02]">

                    Save Changes

                </button>

            </form>

        </div>

    </div>

</section>

@endsection
