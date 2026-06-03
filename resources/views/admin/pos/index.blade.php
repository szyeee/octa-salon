@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-10">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">POS Kasir & Walk-In</h1>
            <p class="mt-2 text-slate-500">Payment process for reservations that have completed service (Status: Arrived).</p>
        </div>
        <a href="{{ route('admin.transactions.create') }}" class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-3 text-sm font-semibold text-white shadow-md hover:opacity-90 transition self-start md:self-auto">
            + Transaksi Walk-In Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-2xl text-sm font-medium">
             {{ session('success') }}
        </div>
    @endif

    {{-- ================= TABEL ATAS: ANTREAN RESERVASI ================= --}}
    <div class="bg-white rounded-[2rem] border border-pink-100 shadow-xl overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-pink-50 text-pink-700 text-sm font-bold border-b border-pink-100">
                    <th class="p-5">Customer</th>
                    <th class="p-5">Service</th>
                    <th class="p-5">Total Bill</th>
                    <th class="p-5 text-center">Payment Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                @forelse($queue as $item)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-5 font-semibold text-slate-800">
                        </td>
                        <td class="p-5">
                            <span class="px-2.5 py-1 text-xs font-semibold bg-purple-50 text-purple-600 rounded-md">
                                {{ $item->service->name }}
                            </span>
                        </td>
                        <td class="p-5 font-bold text-pink-600 text-base">
                            Rp {{ number_format($item->service->price, 0, ',', '.') }}
                        </td>
                        <td class="p-5">
                            <form method="POST" action="{{ route('admin.pos.pay', $item->id_reservation) }}" class="flex items-center justify-center gap-2">
                                @csrf
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-xs text-slate-400 font-bold">Rp</span>
                                    <input type="number" name="amount_paid" placeholder="{{ $item->service->price }}" min="{{ $item->service->price }}" required
                                           class="w-40 rounded-xl border border-slate-200 pl-8 pr-3 py-2 text-xs focus:border-pink-400 outline-none transition font-semibold text-slate-700">
                                </div>
                                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-4 py-2 rounded-xl text-xs shadow-md shadow-emerald-100 transition-all">
                                    Pay in Full
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-16 text-center text-slate-400 font-medium">
                            There is no payment queue from the current reservation.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ================= TABEL BAWAH: RIWAYAT TRANSAKSI ================= --}}
    <div class="mt-12">
        <h2 class="text-xl font-bold text-slate-800 mb-4">Today's Transaction History</h2>
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-700 text-sm font-bold border-b border-slate-100">
                        <th class="p-5">Customer</th>
                        <th class="p-5">Type</th>
                        <th class="p-5">Total Payment</th>
                        <th class="p-5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                    @forelse($history as $trx)
                        <tr class="hover:bg-slate-50/50 transition">
                        
                            <td class="p-5 font-semibold text-slate-800">
                                @if(!empty($trx->customer_name) && $trx->customer_name !== 'Pelanggan Reservasi')
                                    {{-- Jika di database sudah ada nama aslinya, langsung tampilkan --}}
                                    {{ $trx->customer_name }}
                                @elseif($trx->reservation && $trx->reservation->user)
                                    {{-- JIKA data di database terlanjur null / bertuliskan 'Pelanggan Reservasi', kita tarik live dari tabel users --}}
                                    {{ $trx->reservation->user->nama }}
                                @else
                                    {{-- Batas aman terakhir untuk transaksi Walk-In biasa --}}
                                    {{ $trx->customer_name ?? 'Pelanggan Salon' }}
                                @endif
                            </td>

                            <td class="p-5">
                                <span class="px-2.5 py-1 text-xs font-semibold {{ $trx->id_reservation ? 'bg-blue-50 text-blue-600' : 'bg-amber-50 text-amber-600' }} rounded-md">
                                    {{ $trx->id_reservation ? 'Reservasi' : 'Walk-In' }}
                                </span>
                            </td>
                            <td class="p-5 font-bold text-slate-700">
                                Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                            </td>
                            <td class="p-5">
                                <span class="px-2.5 py-1 text-xs font-bold bg-emerald-100 text-emerald-700 rounded-full">
                                    {{ strtoupper($trx->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-slate-400">Belum ada transaksi keluar hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection