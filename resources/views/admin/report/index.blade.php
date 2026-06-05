@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-10">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 pb-6 border-b border-slate-200/80">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Salon Income Report</h1>
            <p class="mt-1 text-sm text-slate-500">Monitor the development of turnover, transaction types, and best-selling services at Octa Salon.</p>
        </div>
        
        {{-- FORM FILTER & EXPORT --}}
        <form method="GET" action="{{ route('admin.report.index') }}" class="flex flex-wrap items-center gap-3 bg-slate-50 p-2 rounded-2xl border border-slate-200/60 ">
            <div class="flex items-center gap-2 pl-2">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">From:</span>
                <input type="date" name="start_date" value="{{ $startDate }}" 
                       class="rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 outline-none focus:border-pink-400 focus:ring-1 focus:ring-pink-400/50 transition">
            </div>
            <div class="flex items-center gap-2 border-l border-slate-200 pl-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">To:</span>
                <input type="date" name="end_date" value="{{ $endDate }}" 
                       class="rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 outline-none focus:border-pink-400 focus:ring-1 focus:ring-pink-400/50 transition">
            </div>
            
            {{-- DROPDOWN FILTER TIPE TRANSAKSI --}}
            <div class="flex items-center gap-2 border-l border-slate-200 pl-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Type:</span>
                <select name="type" class="rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 outline-none focus:border-pink-400 transition">
                    <option value="all" {{ $type == 'all' ? 'selected' : '' }}>All Transactions</option>
                    <option value="app" {{ $type == 'app' ? 'selected' : '' }}>App Reservation</option>
                    <option value="walkin" {{ $type == 'walkin' ? 'selected' : '' }}>Walk-In</option>
                </select>
            </div>

            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-medium px-4 py-1.5 rounded-xl text-xs shadow-sm transition-all tracking-wide">
                Search
            </button>

            {{-- TOMBOL DOWNLOAD EXCEL --}}
            <button type="submit" name="export" value="excel" class="bg-emerald-600 hover:bg-emerald-500 text-white font-semibold px-4 py-1.5 rounded-xl text-xs shadow-sm transition-all tracking-wide flex items-center gap-1">
                Export Excel
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-8 mb-10">
        {{-- Total Revenue --}}
        <div class="bg-gradient-to-br from-pink-500 to-rose-500 p-5 rounded-2xl text-white shadow-md shadow-pink-100 transition-all hover:scale-[1.01]">
            <div class="flex items-center justify-between">
                <h3 class="text-xs font-semibold uppercase tracking-wider opacity-80">Total Revenue</h3>
            </div>
            <p class="text-2xl font-black mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>

        {{-- Total Transactions --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm transition-all hover:scale-[1.01]">
            <div class="flex items-center justify-between">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Transactions</h3>
            </div>
            <p class="text-2xl font-bold text-slate-800 mt-2">{{ $totalTransactions }} <span class="text-xs font-normal text-slate-400">Transactions</span></p>
        </div>

        {{-- via App Reservation --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm transition-all hover:scale-[1.01]">
            <div class="flex items-center justify-between">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400">via App Reservation</h3>
            </div>
            <p class="text-2xl font-bold text-blue-600 mt-2">{{ $totalReservations }} <span class="text-xs font-normal text-slate-400">Transactions</span></p>
        </div>

        {{-- via Walk-In --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm transition-all hover:scale-[1.01]">
            <div class="flex items-center justify-between">
                <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400">via Walk-In</h3>
            </div>
            <p class="text-2xl font-bold text-amber-600 mt-2">{{ $totalWalkIn }} <span class="text-xs font-normal text-slate-400">Transactions</span></p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- TABEL 5 LAYANAN TERLARIS --}}
        <div class="lg:col-span-1 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col">
            <div class="mb-4">
                <h2 class="text-base font-bold text-slate-800 flex items-center gap-2">
                    Bestselling Services
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">Most in-demand treatments.</p>
            </div>
            <div class="overflow-hidden rounded-xl border border-slate-100 flex-1">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50/70 text-slate-500 font-bold border-b border-slate-200/60 uppercase tracking-wider text-[10px]">
                            <th class="p-3 pl-4">Service Name</th>
                            <th class="p-3 text-center">Sold Count</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse($topServices as $service)
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="p-3 pl-4 font-semibold text-slate-800">{{ $service->name }}</td>
                                <td class="p-3 text-center">
                                    <span class="px-2.5 py-1 text-xs font-bold bg-pink-50 text-pink-600 rounded-full">
                                        {{ $service->total_sold }}x
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="p-8 text-center text-slate-400">No sales data yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- TABEL DETAIL RIWAYAT TRANSAKSI TERFILTER --}}
        <div class="lg:col-span-2 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col">
            <div class="mb-4">
                <h2 class="text-base font-bold text-slate-800 flex items-center gap-2">
                    Incoming Transaction Details
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">List of settled invoices within selected dates.</p>
            </div>
            <div class="overflow-x-auto rounded-xl border border-slate-100 flex-1">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50/70 text-slate-500 font-bold border-b border-slate-200/60 uppercase tracking-wider text-[10px]">
                            <th class="p-3 pl-4">Customer</th>
                            <th class="p-3">Type</th>
                            <th class="p-3">Payment Date</th>
                            <th class="p-3 pr-4 text-right">Total Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse($transactions as $trx)
                            <tr class="hover:bg-slate-50/40 transition">
                                <td class="p-3 pl-4 font-semibold text-slate-800">
                                    @if(!empty($trx->customer_name) && $trx->customer_name !== 'Pelanggan Reservasi')
                                        {{ $trx->customer_name }}
                                    @elseif($trx->reservation && $trx->reservation->user)
                                        {{ $trx->reservation->user->nama }}
                                    @else
                                        {{ $trx->customer_name ?? 'Regular Customer' }}
                                    @endif
                                </td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide {{ $trx->id_reservation ? 'bg-blue-50 text-blue-600 border border-blue-100' : 'bg-amber-50 text-amber-600 border border-amber-100' }} rounded-md">
                                        {{ $trx->id_reservation ? 'App' : 'Walk-In' }}
                                    </span>
                                </td>
                                <td class="p-3 text-slate-400">
                                    {{ $trx->created_at->format('d M Y, H:i') }} WIB
                                </td>
                                <td class="p-3 pr-4 font-bold text-slate-800 text-right">
                                    Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-12 text-center text-slate-400">No transactions were found in this date range.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection