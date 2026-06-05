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
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="m5 3 1 2.5L8.5 6 6 7 5 9.5 4 7 1.5 6 4 5.5z"/><path d="m19 17 1 2.5 2.5.5-2.5 1-1 2.5-1-2.5-2.5-1 2.5-1z"/></svg>
                Premium Beauty Treatment
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
                           class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-md hover:scale-105 transition duration-300">
                            Book Now
                        </a>
                        @else
                        <a href="/login"
                           class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-md hover:scale-105 transition duration-300">
                            Login First
                        </a>
                        @endauth

                    </div>

                </div>

            </div>
        @empty
            {{-- Tampilan Cadangan Jika Admin Menghapus Semua Layanan --}}
            <div class="col-span-full flex flex-col items-center justify-center text-center py-20 bg-pink-50/20 rounded-[2rem] border-2 border-dashed border-pink-200">
                
                <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center text-pink-500 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"/><path d="M2 7h20"/><path d="M22 7v3a2 2 0 0 1-2 2v0a2 2 0 0 1-2-2V7"/><path d="M14 7v3a2 2 0 0 1-2 2v0a2 2 0 0 1-2-2V7"/><path d="M6 7v3a2 2 0 0 1-2 2v0a2 2 0 0 1-2-2V7"/></svg>
                </div>

                <p class="text-slate-500 font-medium text-lg">
                    Currently, there are no services available at Salon Octa.
                </p>
                
            </div>
        @endforelse

    </div>
</section>

@endsection