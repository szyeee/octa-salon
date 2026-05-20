@extends('layouts.app')

@section('content')

{{-- HERO --}}
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

{{-- SERVICES --}}
<section class="max-w-7xl mx-auto px-6 py-16">

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">

        @php

        $services = [

            [
                'id' => 1,
                'name' => 'Hair Spa & Creambath',
                'price' => '150.000',
                'duration' => '90 Minutes',
                'image' => 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Nourishing treatment to repair and strengthen your hair.'
            ],

            [
                'id' => 2,
                'name' => 'Hair Smoothing',
                'price' => '250.000',
                'duration' => '120 Minutes',
                'image' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Smooth, silky and elegant hair treatment.'
            ],

            [
                'id' => 3,
                'name' => 'Hair Mask',
                'price' => '120.000',
                'duration' => '60 Minutes',
                'image' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Deep treatment for dry and damaged hair.'
            ],

            [
                'id' => 4,
                'name' => 'Hair Blow',
                'price' => '80.000',
                'duration' => '45 Minutes',
                'image' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Elegant blow styling for glamorous hair.'
            ],

            [
                'id' => 5,
                'name' => 'Hair Styling & Catok',
                'price' => '100.000',
                'duration' => '50 Minutes',
                'image' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Stylish straight hair with premium styling tools.'
            ],

            [
                'id' => 6,
                'name' => 'Relaxing Massage',
                'price' => '200.000',
                'duration' => '90 Minutes',
                'image' => 'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Relax your body and mind with premium massage therapy.'
            ]

        ];

        @endphp

        @foreach($services as $service)

        <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

            <div class="relative overflow-hidden">

                <img
                    src="{{ $service['image'] }}"
                    class="h-64 w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="absolute top-4 left-4 rounded-full bg-pink-500 px-4 py-2 text-sm font-semibold text-white shadow-lg">

                    {{ $service['duration'] }}

                </div>

            </div>

            <div class="p-7">

                <h3 class="text-2xl font-bold text-slate-800">

                    {{ $service['name'] }}

                </h3>

                <p class="mt-3 leading-7 text-slate-500">

                    {{ $service['description'] }}

                </p>

                <div class="mt-7 flex items-center justify-between">

                    <p class="text-2xl font-bold text-pink-600">

                        Rp {{ $service['price'] }}

                    </p>

                    @auth

                    <button
                        onclick="window.location.href='{{ url('/booking/create/'.$service['id']) }}'"
                        type="button"
                        class="relative z-[9999] cursor-pointer rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:scale-105">

                        Book Now

                    </button>

                    @else

                    <button
                        onclick="window.location.href='/login'"
                        type="button"
                        class="relative z-[9999] cursor-pointer rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:scale-105">

                        Login First

                    </button>

                    @endauth

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>

@endsection