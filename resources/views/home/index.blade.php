@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden">

    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-pink-200 rounded-full blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>

    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-rose-200 rounded-full blur-3xl opacity-30 translate-x-1/3 translate-y-1/3"></div>

    <div class="max-w-7xl mx-auto px-6 py-24 relative z-10">

        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <div>

                <span class="inline-flex items-center gap-2 rounded-full bg-pink-100 px-5 py-2 text-sm font-semibold text-pink-600 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="m5 3 1 2.5L8.5 6 6 7 5 9.5 4 7 1.5 6 4 5.5z"/><path d="m19 17 1 2.5 2.5.5-2.5 1-1 2.5-1-2.5-2.5-1 2.5-1z"/></svg>
                    Luxury Beauty Experience
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

                        <div class="text-4xl font-extrabold text-pink-600 flex items-center gap-1">
                            4.9
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-pink-600"><path d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
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

                            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-white">

                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="m5 3 1 2.5L8.5 6 6 7 5 9.5 4 7 1.5 6 4 5.5z"/><path d="m19 17 1 2.5 2.5.5-2.5 1-1 2.5-1-2.5-2.5-1 2.5-1z"/></svg>

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

<section class="max-w-7xl mx-auto px-6 py-16 bg-pink-50/20">
    
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6 items-stretch">
        
        <div class="flex flex-col h-full rounded-[2rem] border border-pink-100 bg-white p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300">

            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-pink-50 text-pink-500 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
            </div>

            <h3 class="text-2xl font-extrabold text-slate-800 leading-tight">
                Relaxing Treatment
            </h3>

            <p class="mt-4 text-slate-500 text-sm leading-6 flex-grow">
                Enjoy calming and luxurious salon experiences for your beauty and comfort.
            </p>
        </div>

        <div class="flex flex-col h-full rounded-[2rem] border border-pink-100 bg-white p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300">

            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-pink-50 text-pink-500 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
            </div>

            <h3 class="text-2xl font-extrabold text-slate-800 leading-tight">
                Premium Products
            </h3>

            <p class="mt-4 text-slate-500 text-sm leading-6 flex-grow">
                High-quality salon products for healthy hair and glowing beauty results.
            </p>
        </div>

        <div class="flex flex-col h-full rounded-[2rem] border border-pink-100 bg-white p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300">

            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-pink-50 text-pink-500 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 9V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v3"/><path d="M3 11v5a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2Z"/><path d="M5 18v2"/><path d="M19 18v2"/></svg>
            </div>

            <h3 class="text-2xl font-extrabold text-slate-800 leading-tight">
                Elegant Atmosphere
            </h3>

            <p class="mt-4 text-slate-500 text-sm leading-6 flex-grow">
                Feel comfortable with our modern, clean, and aesthetic salon environment.
            </p>
        </div>

        <div class="flex flex-col h-full rounded-[2rem] border border-pink-100 bg-white p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300">

            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-pink-50 text-pink-500 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
            </div>

            <h3 class="text-2xl font-extrabold text-slate-800 leading-tight">
                Trusted Service
            </h3>
            
            <p class="mt-4 text-slate-500 text-sm leading-6 flex-grow">
                Loved by many customers with professional service and satisfying treatments.
            </p>
        </div>

    </div>
</section>

@endsection