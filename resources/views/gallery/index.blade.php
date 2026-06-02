@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden bg-gradient-to-r from-pink-500 via-rose-500 to-pink-600 py-24">
    <div class="max-w-7xl mx-auto px-6 text-center text-white relative z-10">
        <span class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/10 px-5 py-2 text-sm backdrop-blur">
            ✨ Beautiful Moments
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
            <div class="col-span-full text-center py-16 bg-white rounded-[2rem] border border-pink-100 shadow-sm">
                <p class="text-slate-400 font-medium">No photographs available in this category yet.</p>
            </div>
        @endforelse

    </div>
</section>

@endsection