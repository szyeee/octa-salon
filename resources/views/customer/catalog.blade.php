@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-10">

    <div class="bg-gradient-to-r from-pink-500 to-rose-500 rounded-[2rem] p-10 text-white shadow-2xl">

        <h1 class="text-5xl font-extrabold leading-tight">
            Premium Salon Experience
        </h1>

        <p class="mt-5 text-white/90 max-w-2xl">
            Discover elegant beauty treatments with a luxurious salon experience.
        </p>

    </div>

    <div class="mt-10">

        <h2 class="text-3xl font-bold text-slate-800">
            Our Services
        </h2>

    </div>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8 mt-8">

        @foreach($services as $service)

        <div class="bg-white rounded-[2rem] overflow-hidden shadow-lg border border-pink-100">

            <img
                src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1200&q=80"
                class="w-full h-60 object-cover">

            <div class="p-6">

                <h3 class="text-2xl font-bold text-slate-800">
                    {{ $service->name }}
                </h3>

                <p class="mt-3 text-slate-500">
                    {{ $service->description }}
                </p>

                <div class="mt-5 flex justify-between items-center">

                    <div>

                        <p class="text-sm text-slate-400">
                            Price
                        </p>

                        <p class="text-xl font-bold text-pink-600">
                            Rp {{ number_format($service->price,0,',','.') }}
                        </p>

                    </div>

                    <a href="/booking/create/{{ $service->id }}"
                       class="px-5 py-3 rounded-full bg-gradient-to-r from-pink-500 to-rose-500 text-white font-semibold shadow-lg">
                        Book
                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>

@endsection