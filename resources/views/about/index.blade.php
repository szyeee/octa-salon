@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-pink-500 via-rose-500 to-fuchsia-500"></div>

    <div class="absolute inset-y-0 right-0 w-[35%] opacity-20 hidden lg:block">
        <svg viewBox="0 0 500 500" class="h-full w-full">
            <path d="M250 100 C300 200, 400 200, 450 300" stroke="white" stroke-width="3" fill="none"/>
            <path d="M250 100 C200 200, 100 250, 120 380" stroke="white" stroke-width="3" fill="none"/>
            <path d="M300 120 C360 170, 420 220, 460 340" stroke="white" stroke-width="2" fill="none" opacity="0.7"/>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-24">
        <div class="max-w-3xl text-center mx-auto">
            <span class="inline-flex items-center rounded-full bg-white/15 px-5 py-2 text-sm font-medium text-white backdrop-blur">
                ✨ About Octa Salon
            </span>

            <h1 class="mt-6 text-5xl md:text-6xl font-extrabold leading-tight text-white">
                About Us
            </h1>

            <p class="mt-5 text-lg leading-8 text-white/90">
                Your trusted beauty destination.
            </p>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-10">
    <div class="grid lg:grid-cols-2 gap-10 items-center">
        <div class="overflow-hidden rounded-[1.75rem] shadow-xl">
            <img
                src="https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=1200&q=80"
                class="h-[420px] w-full object-cover"
                alt="About salon"
            >
        </div>

        <div>
            <h2 class="text-4xl font-extrabold text-slate-900 leading-tight">
                Beauty, Quality, And You
            </h2>

            <p class="mt-5 text-slate-500 leading-8">
                Octa Salon is dedicated to providing premium salon services with professional care, high-quality products, and a relaxing atmosphere.
            </p>

            <p class="mt-4 text-slate-500 leading-8">
                Our mission is to help every client feel beautiful, confident, and refreshed after every treatment.
            </p>

            <div class="grid grid-cols-2 gap-5 mt-8">
                <div class="rounded-2xl bg-pink-50 p-5 border border-pink-100">
                    <div class="text-3xl font-extrabold text-pink-600">5+</div>
                    <div class="mt-1 text-sm font-medium text-slate-600">Years Experience</div>
                </div>

                <div class="rounded-2xl bg-pink-50 p-5 border border-pink-100">
                    <div class="text-3xl font-extrabold text-pink-600">1K+</div>
                    <div class="mt-1 text-sm font-medium text-slate-600">Happy Customers</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-10 pb-20">
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="rounded-[1.5rem] bg-white border border-pink-100 p-6 shadow-md text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-pink-100 text-pink-600 text-xl">👩‍💼</div>
            <h3 class="mt-4 font-bold text-slate-800">Professional Staff</h3>
            <p class="mt-2 text-sm text-slate-500 leading-7">Our team consists of experienced and certified beauty experts.</p>
        </div>

        <div class="rounded-[1.5rem] bg-white border border-pink-100 p-6 shadow-md text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-pink-100 text-pink-600 text-xl">💎</div>
            <h3 class="mt-4 font-bold text-slate-800">Premium Products</h3>
            <p class="mt-2 text-sm text-slate-500 leading-7">We use high-quality products for the best results.</p>
        </div>

        <div class="rounded-[1.5rem] bg-white border border-pink-100 p-6 shadow-md text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-pink-100 text-pink-600 text-xl">🛋️</div>
            <h3 class="mt-4 font-bold text-slate-800">Comfortable Place</h3>
            <p class="mt-2 text-sm text-slate-500 leading-7">Relaxing and clean environment for your comfort.</p>
        </div>

        <div class="rounded-[1.5rem] bg-white border border-pink-100 p-6 shadow-md text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-pink-100 text-pink-600 text-xl">❤️</div>
            <h3 class="mt-4 font-bold text-slate-800">Customer Satisfaction</h3>
            <p class="mt-2 text-sm text-slate-500 leading-7">Your satisfaction is our biggest priority.</p>
        </div>
    </div>
</section>

@endsection