@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden">

    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-pink-200 rounded-full blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>

    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-rose-200 rounded-full blur-3xl opacity-30 translate-x-1/3 translate-y-1/3"></div>

    <div class="max-w-7xl mx-auto px-6 py-24 relative z-10">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div>

                <span class="inline-flex items-center gap-2 rounded-full bg-pink-100 px-5 py-2 text-sm font-semibold text-pink-600 shadow-sm">

                    ✨ Luxury Beauty Experience

                </span>

                <h1 class="mt-8 text-6xl leading-tight font-extrabold text-slate-900">

                    Discover Your
                    <span class="bg-gradient-to-r from-pink-500 to-rose-500 bg-clip-text text-transparent">
                        Beautiful Glow
                    </span>

                </h1>

                <p class="mt-6 text-lg leading-9 text-slate-500 max-w-xl">

                    Experience premium salon treatments with elegant service,
                    professional care, and luxurious beauty moments made specially for you.

                </p>

                <div class="mt-10 flex flex-wrap gap-4">

                    <a href="/services"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-8 py-4 text-white font-semibold shadow-xl shadow-pink-200 hover:scale-105 transition-all duration-300">

                        Explore Services

                    </a>

                    @guest

                    <a href="/register"
                       class="rounded-full border border-pink-200 bg-white px-8 py-4 text-pink-600 font-semibold hover:bg-pink-50 transition-all">

                        Create Account

                    </a>

                    @endguest

                </div>

                <div class="mt-14 grid grid-cols-3 gap-6">

                    <div class="rounded-3xl bg-white border border-pink-100 p-6 shadow-lg">

                        <div class="text-4xl font-extrabold text-pink-600">
                            1K+
                        </div>

                        <div class="mt-2 text-sm text-slate-500">
                            Happy Customers
                        </div>

                    </div>

                    <div class="rounded-3xl bg-white border border-pink-100 p-6 shadow-lg">

                        <div class="text-4xl font-extrabold text-pink-600">
                            15+
                        </div>

                        <div class="mt-2 text-sm text-slate-500">
                            Premium Treatments
                        </div>

                    </div>

                    <div class="rounded-3xl bg-white border border-pink-100 p-6 shadow-lg">

                        <div class="text-4xl font-extrabold text-pink-600">
                            4.9★
                        </div>

                        <div class="mt-2 text-sm text-slate-500">
                            Customer Rating
                        </div>

                    </div>

                </div>

            </div>

            <div class="relative">

                <div class="absolute -top-6 -left-6 w-32 h-32 rounded-full bg-pink-200 blur-3xl opacity-40"></div>

                <div class="absolute bottom-0 right-0 w-40 h-40 rounded-full bg-rose-200 blur-3xl opacity-40"></div>

                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border border-white/50">

                    <img
                        src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1400&q=80"
                        class="w-full h-[700px] object-cover hover:scale-105 transition duration-700">

                    <div class="absolute bottom-8 left-8 right-8 rounded-3xl bg-white/20 backdrop-blur-xl border border-white/30 p-6 text-white shadow-xl">

                        <div class="flex items-center justify-between">

                            <div>

                                <div class="text-sm text-white/80">
                                    Featured Treatment
                                </div>

                                <div class="mt-2 text-2xl font-bold">
                                    Hair Spa & Creambath
                                </div>

                            </div>

                            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl">

                                ✨

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="max-w-7xl mx-auto px-6 py-24">

    <div class="text-center">

        <span class="text-pink-500 font-semibold uppercase tracking-[0.3em] text-sm">
            Why Choose Us
        </span>

        <h2 class="mt-5 text-5xl font-extrabold text-slate-900">
            Premium Salon Experience
        </h2>

        <p class="mt-6 text-lg text-slate-500 max-w-3xl mx-auto leading-9">

            We provide luxury beauty treatments with elegant atmosphere,
            professional care, and modern salon services.

        </p>

    </div>

    <div class="mt-20 grid md:grid-cols-2 xl:grid-cols-4 gap-8">

        <div class="group rounded-[2rem] bg-white border border-pink-100 p-8 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">

            <div class="w-16 h-16 rounded-2xl bg-pink-100 flex items-center justify-center text-3xl">

                💆‍♀️

            </div>

            <h3 class="mt-6 text-2xl font-bold text-slate-800">
                Relaxing Treatment
            </h3>

            <p class="mt-4 leading-8 text-slate-500">

                Enjoy calming and luxurious salon experiences for your beauty and comfort.

            </p>

        </div>

        <div class="group rounded-[2rem] bg-white border border-pink-100 p-8 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">

            <div class="w-16 h-16 rounded-2xl bg-pink-100 flex items-center justify-center text-3xl">

                ✨

            </div>

            <h3 class="mt-6 text-2xl font-bold text-slate-800">
                Premium Products
            </h3>

            <p class="mt-4 leading-8 text-slate-500">

                High-quality salon products for healthy hair and glowing beauty results.

            </p>

        </div>

        <div class="group rounded-[2rem] bg-white border border-pink-100 p-8 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">

            <div class="w-16 h-16 rounded-2xl bg-pink-100 flex items-center justify-center text-3xl">

                🌸

            </div>

            <h3 class="mt-6 text-2xl font-bold text-slate-800">
                Elegant Atmosphere
            </h3>

            <p class="mt-4 leading-8 text-slate-500">

                Feel comfortable with our modern, clean, and aesthetic salon environment.

            </p>

        </div>

        <div class="group rounded-[2rem] bg-white border border-pink-100 p-8 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">

            <div class="w-16 h-16 rounded-2xl bg-pink-100 flex items-center justify-center text-3xl">

                💖

            </div>

            <h3 class="mt-6 text-2xl font-bold text-slate-800">
                Trusted Service
            </h3>

            <p class="mt-4 leading-8 text-slate-500">

                Loved by many customers with professional service and satisfying treatments.

            </p>

        </div>

    </div>

</section>

@endsection