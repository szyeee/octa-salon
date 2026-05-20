@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden bg-gradient-to-r from-pink-500 via-rose-500 to-pink-600 py-24">

    <div class="absolute top-0 right-0 opacity-20">

        <svg width="320" height="320" fill="none" viewBox="0 0 320 320">

            <path d="M240 40C180 100 160 180 200 260" stroke="white" stroke-width="2"/>

            <path d="M180 60C220 120 260 180 260 260" stroke="white" stroke-width="2"/>

            <path d="M120 120C160 160 200 200 240 240" stroke="white" stroke-width="2"/>

        </svg>

    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <div class="text-center text-white">

            <span class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/10 px-5 py-2 text-sm backdrop-blur">

                ✨ Premium Beauty Treatment

            </span>

            <h1 class="mt-8 text-5xl md:text-6xl font-extrabold tracking-tight">

                Our Services

            </h1>

            <p class="mt-5 text-lg text-white/90 max-w-2xl mx-auto">

                Professional salon treatments for your beauty and confidence.

            </p>

        </div>

    </div>

</section>

<section class="max-w-7xl mx-auto px-6 py-16">

    <div>

        <h2 class="text-3xl font-bold text-slate-800">

            Our Premium Services

        </h2>

        <p class="mt-2 text-slate-500">

            Choose the perfect treatment for your beauty journey.

        </p>

    </div>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8 mt-10">

        {{-- CREAMBATH --}}
        <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

            <div class="relative overflow-hidden">

                <img
                    src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1200&q=80"
                    class="h-64 w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="absolute top-4 left-4 rounded-full bg-pink-500 px-4 py-2 text-sm font-semibold text-white shadow-lg">

                    90 Minutes

                </div>

            </div>

            <div class="p-7">

                <h3 class="text-2xl font-bold text-slate-800">

                    Hair Spa & Creambath

                </h3>

                <p class="mt-3 leading-7 text-slate-500">

                    Nourishing treatment to repair and strengthen your hair.

                </p>

                <div class="mt-7 flex items-center justify-between">

                    <p class="text-2xl font-bold text-pink-600">

                        Rp 150.000

                    </p>

                    @auth
                    <a href="/booking/create/1"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:scale-105">
                        Book Now
                    </a>
                    @else
                    <a href="/login"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:scale-105">
                        Login First
                    </a>
                    @endauth

                </div>

            </div>

        </div>

        {{-- SMOOTHING --}}
        <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

            <div class="relative overflow-hidden">

                <img
                    src="https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=1200&q=80"
                    class="h-64 w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="absolute top-4 left-4 rounded-full bg-pink-500 px-4 py-2 text-sm font-semibold text-white shadow-lg">

                    120 Minutes

                </div>

            </div>

            <div class="p-7">

                <h3 class="text-2xl font-bold text-slate-800">

                    Hair Smoothing

                </h3>

                <p class="mt-3 leading-7 text-slate-500">

                    Smooth, silky and elegant hair treatment.

                </p>

                <div class="mt-7 flex items-center justify-between">

                    <p class="text-2xl font-bold text-pink-600">

                        Rp 250.000

                    </p>

                    @auth
                    <a href="/booking/create/2"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:scale-105">
                        Book Now
                    </a>
                    @else
                    <a href="/login"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:scale-105">
                        Login First
                    </a>
                    @endauth

                </div>

            </div>

        </div>

        {{-- HAIR MASK --}}
        <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

            <div class="relative overflow-hidden">

                <img
                    src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1200&q=80"
                    class="h-64 w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="absolute top-4 left-4 rounded-full bg-pink-500 px-4 py-2 text-sm font-semibold text-white shadow-lg">

                    60 Minutes

                </div>

            </div>

            <div class="p-7">

                <h3 class="text-2xl font-bold text-slate-800">

                    Hair Mask

                </h3>

                <p class="mt-3 leading-7 text-slate-500">

                    Deep treatment for dry and damaged hair.

                </p>

                <div class="mt-7 flex items-center justify-between">

                    <p class="text-2xl font-bold text-pink-600">

                        Rp 120.000

                    </p>

                    @auth
                    <a href="/booking/create/3"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:scale-105">
                        Book Now
                    </a>
                    @else
                    <a href="/login"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:scale-105">
                        Login First
                    </a>
                    @endauth

                </div>

            </div>

        </div>

    </div>

</section>

@endsection