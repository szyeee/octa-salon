@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden bg-gradient-to-r from-pink-500 via-rose-500 to-pink-600 py-24">
    <div class="max-w-7xl mx-auto px-6 text-center text-white relative z-10">
        <span class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/10 px-5 py-2 text-sm backdrop-blur">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="m5 3 1 2.5L8.5 6 6 7 5 9.5 4 7 1.5 6 4 5.5z"/><path d="m19 17 1 2.5 2.5.5-2.5 1-1 2.5-1-2.5-2.5-1 2.5-1z"/></svg>
            Beautiful Moments
        </span>
        <h1 class="mt-8 text-5xl md:text-6xl font-extrabold tracking-tight">
            Our Gallery
        </h1>
        <p class="mt-5 text-lg text-white/90 max-w-2xl mx-auto">
            Discover our salon atmosphere and beauty transformations.
        </p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 pt-12">
    <div class="flex flex-wrap justify-center gap-3">
        <a href="?category=all" 
           class="px-6 py-2.5 text-sm font-semibold rounded-full transition shadow-sm
           {{ $currentCategory == 'all' ? 'bg-pink-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:border-pink-300' }}">
            All
        </a>
        <a href="?category=hair-treatment" 
           class="px-6 py-2.5 text-sm font-semibold rounded-full transition shadow-sm
           {{ $currentCategory == 'hair-treatment' ? 'bg-pink-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:border-pink-300' }}">
            Hair Treatment
        </a>
        <a href="?category=salon-interior" 
           class="px-6 py-2.5 text-sm font-semibold rounded-full transition shadow-sm
           {{ $currentCategory == 'salon-interior' ? 'bg-pink-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:border-pink-300' }}">
            Salon Interior
        </a>
        <a href="?category=makeup" 
           class="px-6 py-2.5 text-sm font-semibold rounded-full transition shadow-sm
           {{ $currentCategory == 'makeup' ? 'bg-pink-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:border-pink-300' }}">
            Makeup
        </a>
        <a href="?category=before-after" 
           class="px-6 py-2.5 text-sm font-semibold rounded-full transition shadow-sm
           {{ $currentCategory == 'before-after' ? 'bg-pink-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:border-pink-300' }}">
            Before & After
        </a>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-12">
    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">

        @forelse($galleries as $item)
            <div class="group overflow-hidden rounded-[2rem] border border-pink-100 bg-white shadow-lg hover:-translate-y-2 hover:shadow-2xl transition duration-300">
                
                <div class="overflow-hidden h-64 w-full bg-slate-100">
                    <img src="{{ $item['url'] }}" alt="{{ $item['title'] }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                </div>

                <div class="p-6">
                    <span class="inline-block px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider bg-pink-50 text-pink-600 rounded-md mb-2">
                        {{ str_replace('-', ' ', $item['category']) }}
                    </span>
                    <h3 class="text-lg font-bold text-slate-800">
                        {{ $item['title'] }}
                    </h3>
                </div>

            </div>
        @empty
            {{-- Tampilan Cadangan Jika Foto Kosong --}}
            <div class="col-span-full flex flex-col items-center justify-center text-center py-20 bg-pink-50/10 rounded-[2rem] border border-dashed border-pink-200 shadow-sm">
                
                <div class="w-16 h-16 rounded-full bg-pink-50 flex items-center justify-center text-pink-500 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                </div>

                <p class="text-slate-400 font-medium">
                    No photographs available in this category yet.
                </p>
                
            </div>
        @endforelse

    </div>
</section>

@endsection