@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-12">

    <h1 class="text-4xl font-extrabold text-slate-800">
        Booking History
    </h1>

    <p class="mt-3 text-slate-500">
        View all your salon appointments.
    </p>

    @if(session('success'))
        <div class="mt-6 rounded-2xl bg-green-100 px-5 py-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @php $currentTab = request('tab', 'pending'); @endphp
    <div class="flex gap-4 mt-8 mb-6 border-b border-slate-200 pb-px overflow-x-auto">
        <a href="?tab=pending" class="px-5 py-3 text-sm font-semibold border-b-2 whitespace-nowrap transition-all {{ $currentTab == 'pending' ? 'border-pink-600 text-pink-600' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            Waiting Confirmation <span class="ml-1.5 px-2 py-0.5 text-xs bg-pink-100 text-pink-700 rounded-full">{{ $pendingReservations->count() }}</span>
        </a>
        <a href="?tab=confirmed" class="px-5 py-3 text-sm font-semibold border-b-2 whitespace-nowrap transition-all {{ $currentTab == 'confirmed' ? 'border-pink-600 text-pink-600' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            Confirmed <span class="ml-1.5 px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded-full">{{ $confirmedReservations->count() }}</span>
        </a>
        <a href="?tab=completed" class="px-5 py-3 text-sm font-semibold border-b-2 whitespace-nowrap transition-all {{ $currentTab == 'completed' ? 'border-pink-600 text-pink-600' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            Past History <span class="ml-1.5 px-2 py-0.5 text-xs bg-slate-100 text-slate-700 rounded-full">{{ $completedReservations->count() }}</span>
        </a>
    </div>

    @php
        if($currentTab == 'confirmed') { 
            $dataLoop = $confirmedReservations; 
        } elseif($currentTab == 'completed') { 
            $dataLoop = $completedReservations; 
        } else { 
            $dataLoop = $pendingReservations; 
        }
    @endphp

    <div class="mt-6 grid gap-6">

        @forelse($dataLoop as $reservation)

            <div class="rounded-[2rem] border border-pink-100 bg-white p-8 shadow-lg">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>
                        <div class="inline-flex rounded-full px-4 py-2 text-sm font-semibold 
                            {{ $reservation->status == 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ in_array($reservation->status, ['confirmed', 'arrived']) ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $reservation->status == 'done' ? 'bg-green-100 text-green-700' : '' }}
                            {{ in_array($reservation->status, ['cancelled', 'absent']) ? 'bg-red-100 text-red-700' : '' }}
                        ">
                            {{ ucfirst($reservation->status) }}
                        </div>

                        <h2 class="mt-5 text-3xl font-bold text-slate-800">
                            {{ $reservation->service->name ?? 'Salon Service' }}
                        </h2> 

                        <div class="mt-4 flex flex-wrap gap-6 text-slate-500">
                            <div>
                                {{ isset($reservation->date) ? \Carbon\Carbon::parse($reservation->date)->format('d M Y') : '-' }}
                            </div>
                            <div>
                                {{ isset($reservation->time) ? \Carbon\Carbon::parse($reservation->time)->format('H:i') : '-' }} WIB
                            </div>
                        </div>
                    </div>

                    <!-- BLOK STATUS & TOMBOL LIHAT STRUK -->
                    <div class="flex flex-col items-center lg:items-end gap-3 min-w-[200px]">
                        <div class="w-full rounded-3xl bg-pink-50 px-8 py-6 text-center lg:text-left">
                            <div class="text-sm text-slate-500">
                                Booking Status
                            </div>
                            <div class="mt-2 text-2xl font-bold 
                                {{ $reservation->status == 'done' ? 'text-green-600' : 'text-pink-600' }}
                            ">
                                {{ ucfirst($reservation->status) }}
                            </div>
                        </div>

                        <!-- TOMBOL KELUAR HANYA JIKA STATUS SUDAH DONE (LUNAS/SELESAI) -->
                        @if($reservation->status == 'done' && $reservation->transaction)
                            <a href="{{ route('booking.preview', $reservation->transaction->id_transaction) }}" 
                               class="w-full text-center px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition border border-slate-200">
                                View Receipt
                            </a>
                        @endif
                    </div>

                </div>

            </div>

        @empty

            <div class="rounded-[2rem] bg-white p-16 text-center shadow-lg border border-pink-100">
                <h2 class="mt-6 text-3xl font-bold text-slate-800">
                    No Booking Found
                </h2>

                <p class="mt-3 text-slate-500">
                    There are no appointments in the <strong>{{ ucfirst($currentTab) }}</strong> category right now.
                </p>
            </div>

        @endforelse

    </div>

</section>

@endsection