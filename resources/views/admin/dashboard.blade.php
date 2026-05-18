@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-10">
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Admin Dashboard</h1>
            <p class="mt-2 text-slate-500">Salon operations at a glance.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-3">
        <div class="rounded-[1.5rem] bg-white p-6 shadow-lg shadow-pink-100 border border-pink-50">
            <div class="text-sm text-slate-500">Reservations</div>
            <div class="mt-3 text-4xl font-extrabold text-slate-900">{{ $totalReservations }}</div>
        </div>
        <div class="rounded-[1.5rem] bg-white p-6 shadow-lg shadow-pink-100 border border-pink-50">
            <div class="text-sm text-slate-500">Services</div>
            <div class="mt-3 text-4xl font-extrabold text-slate-900">{{ $totalServices }}</div>
        </div>
        <div class="rounded-[1.5rem] bg-gradient-to-br from-pink-500 to-rose-500 p-6 text-white shadow-lg shadow-pink-200">
            <div class="text-sm text-white/80">Revenue</div>
            <div class="mt-3 text-4xl font-extrabold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
    </div>
</section>
@endsection