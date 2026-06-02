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
                ✨ Beautiful Moments
            </span>

            <h1 class="mt-6 text-5xl md:text-6xl font-extrabold leading-tight text-white">
                Our Gallery
            </h1>

            <p class="mt-5 text-lg leading-8 text-white/90">
                Discover our salon atmosphere and beauty transformations.
            </p>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-10">
    <div class="flex flex-wrap justify-center gap-4 mb-10">
        <button class="rounded-full bg-pink-500 px-6 py-3 text-sm font-semibold text-white shadow-lg">
            All
        </button>
        <button class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-medium text-slate-700 hover:bg-pink-50 transition">
            Hair Treatment
        </button>
        <button class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-medium text-slate-700 hover:bg-pink-50 transition">
            Salon Interior
        </button>
        <button class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-medium text-slate-700 hover:bg-pink-50 transition">
            Makeup
        </button>
        <button class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-medium text-slate-700 hover:bg-pink-50 transition">
            Before & After
        </button>
    </div>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <div class="overflow-hidden rounded-[1.5rem] shadow-lg group">
            <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=1200&q=80"
                 class="h-72 w-full object-cover transition duration-500 group-hover:scale-110"
                 alt="Gallery 1">
        </div>

        <div class="overflow-hidden rounded-[1.5rem] shadow-lg group">
            <img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1200&q=80"
                 class="h-72 w-full object-cover transition duration-500 group-hover:scale-110"
                 alt="Gallery 2">
        </div>

        <div class="overflow-hidden rounded-[1.5rem] shadow-lg group">
            <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=1200&q=80"
                 class="h-72 w-full object-cover transition duration-500 group-hover:scale-110"
                 alt="Gallery 3">
        </div>

        <div class="overflow-hidden rounded-[1.5rem] shadow-lg group">
            <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?auto=format&fit=crop&w=1200&q=80"
                 class="h-72 w-full object-cover transition duration-500 group-hover:scale-110"
                 alt="Gallery 4">
        </div>

        <div class="overflow-hidden rounded-[1.5rem] shadow-lg group">
            <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=1200&q=80"
                 class="h-72 w-full object-cover transition duration-500 group-hover:scale-110"
                 alt="Gallery 5">
        </div>

        <div class="overflow-hidden rounded-[1.5rem] shadow-lg group">
            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=1200&q=80"
                 class="h-72 w-full object-cover transition duration-500 group-hover:scale-110"
                 alt="Gallery 6">
        </div>
    </div>
</section>

@endsection