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

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">

        {{-- SERVICE 1 --}}
        <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg hover:-translate-y-2 hover:shadow-2xl transition">

            <img
                src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1200&q=80"
                class="h-64 w-full object-cover">

            <div class="p-7">

                <h3 class="text-2xl font-bold text-slate-800">
                    Hair Spa & Creambath
                </h3>

                <p class="mt-3 text-slate-500 leading-7">
                    Nourishing treatment to repair and strengthen your hair.
                </p>

                <div class="mt-6 flex items-center justify-between">

                    <p class="text-2xl font-bold text-pink-600">
                        Rp 150.000
                    </p>

                    @auth
                    <a href="/booking/create/1"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Book Now
                    </a>
                    @else
                    <a href="/login"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Login First
                    </a>
                    @endauth

                </div>

            </div>

        </div>

        {{-- SERVICE 2 --}}
        <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg hover:-translate-y-2 hover:shadow-2xl transition">

            <img
                src="https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=1200&q=80"
                class="h-64 w-full object-cover">

            <div class="p-7">

                <h3 class="text-2xl font-bold text-slate-800">
                    Hair Smoothing
                </h3>

                <p class="mt-3 text-slate-500 leading-7">
                    Smooth, silky and elegant hair treatment.
                </p>

                <div class="mt-6 flex items-center justify-between">

                    <p class="text-2xl font-bold text-pink-600">
                        Rp 250.000
                    </p>

                    @auth
                    <a href="/booking/create/2"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Book Now
                    </a>
                    @else
                    <a href="/login"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Login First
                    </a>
                    @endauth

                </div>

            </div>

        </div>

        {{-- SERVICE 3 --}}
        <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg hover:-translate-y-2 hover:shadow-2xl transition">

            <img
                src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1200&q=80"
                class="h-64 w-full object-cover">

            <div class="p-7">

                <h3 class="text-2xl font-bold text-slate-800">
                    Hair Mask
                </h3>

                <p class="mt-3 text-slate-500 leading-7">
                    Deep treatment for dry and damaged hair.
                </p>

                <div class="mt-6 flex items-center justify-between">

                    <p class="text-2xl font-bold text-pink-600">
                        Rp 120.000
                    </p>

                    @auth
                    <a href="/booking/create/3"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Book Now
                    </a>
                    @else
                    <a href="/login"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Login First
                    </a>
                    @endauth

                </div>

            </div>

        </div>

        {{-- SERVICE 4 --}}
        <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg hover:-translate-y-2 hover:shadow-2xl transition">

            <img
                src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=1200&q=80"
                class="h-64 w-full object-cover">

            <div class="p-7">

                <h3 class="text-2xl font-bold text-slate-800">
                    Hair Blow
                </h3>

                <p class="mt-3 text-slate-500 leading-7">
                    Elegant blow styling for glamorous hair.
                </p>

                <div class="mt-6 flex items-center justify-between">

                    <p class="text-2xl font-bold text-pink-600">
                        Rp 80.000
                    </p>

                    @auth
                    <a href="/booking/create/4"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Book Now
                    </a>
                    @else
                    <a href="/login"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Login First
                    </a>
                    @endauth

                </div>

            </div>

        </div>

        {{-- SERVICE 5 --}}
        <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg hover:-translate-y-2 hover:shadow-2xl transition">

            <img
                src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1200&q=80"
                class="h-64 w-full object-cover">

            <div class="p-7">

                <h3 class="text-2xl font-bold text-slate-800">
                    Hair Styling & Catok
                </h3>

                <p class="mt-3 text-slate-500 leading-7">
                    Stylish straight hair with premium styling tools.
                </p>

                <div class="mt-6 flex items-center justify-between">

                    <p class="text-2xl font-bold text-pink-600">
                        Rp 100.000
                    </p>

                    @auth
                    <a href="/booking/create/5"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Book Now
                    </a>
                    @else
                    <a href="/login"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Login First
                    </a>
                    @endauth

                </div>

            </div>

        </div>

        {{-- SERVICE 6 --}}
        <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg hover:-translate-y-2 hover:shadow-2xl transition">

            <img
                src="https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=1200&q=80"
                class="h-64 w-full object-cover">

            <div class="p-7">

                <h3 class="text-2xl font-bold text-slate-800">
                    Relaxing Massage
                </h3>

                <p class="mt-3 text-slate-500 leading-7">
                    Relax your body and mind with premium massage therapy.
                </p>

                <div class="mt-6 flex items-center justify-between">

                    <p class="text-2xl font-bold text-pink-600">
                        Rp 200.000
                    </p>

                    @auth
                    <a href="/booking/create/6"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Book Now
                    </a>
                    @else
                    <a href="/login"
                       class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white">
                        Login First
                    </a>
                    @endauth

                </div>

            </div>

        </div>

    </div>

</section>

@endsection