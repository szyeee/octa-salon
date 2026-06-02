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

        @forelse($services as $service)
            <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg hover:-translate-y-2 hover:shadow-2xl transition">

                @if(str_starts_with($service->image, 'http'))
                    <img src="{{ $service->image }}" class="h-64 w-full object-cover">
                @elseif($service->image && Storage::disk('public')->exists($service->image))
                    <img src="{{ asset('storage/' . $service->image) }}" class="h-64 w-full object-cover">
                @else
                    {{-- Gambar cadangan jika kosong --}}
                    <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=1200&q=80" class="h-64 w-full object-cover">
                @endif

                <div class="p-7">

                    {{-- Nama Layanan --}}
                    <h3 class="text-2xl font-bold text-slate-800">
                        {{ $service->name }}
                    </h3>

                    {{-- Deskripsi --}}
                    <p class="mt-3 text-slate-500 leading-7">
                        {{ $service->description }}
                    </p>

                    <div class="mt-6 flex items-center justify-between">

                        {{-- Harga --}}
                        <p class="text-2xl font-bold text-pink-600">
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </p>

                        @auth
                        <a href="/booking/create/{{ $service->id_service }}"
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
        @empty
            {{-- Tampilan Cadangan Jika Admin Menghapus Semua Layanan --}}
            <div class="col-span-full text-center py-16 bg-pink-50/10 rounded-[2rem] border border-dashed border-pink-200">
                <span class="text-4xl">🌸</span>
                <p class="mt-4 text-slate-500 font-medium">Currently, there are no services available at Salon Octa.</p>
            </div>
        @endforelse

    </div>
</section>

@endsection
