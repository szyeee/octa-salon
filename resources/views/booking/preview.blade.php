@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-md px-6 py-12">
    <div class="mb-6">
        <button>
            <a href="/appointments" class="px-4 py-2 text-xs font-bold text-slate-500 hover:text-slate-700 bg-white border border-slate-200 rounded-xl shadow-sm transition inline-block">
                Back to Booking History
            </a>
        </button>
    </div>

    <div class="bg-white border border-pink-100 rounded-[2rem] shadow-xl p-8 font-mono text-sm text-slate-700">
        
        <div class="text-center border-b border-dashed border-slate-200 pb-4 mb-5">
            <h2 class="text-2xl font-black text-slate-800 tracking-wide uppercase">OCTA SALON</h2>
            <p class="text-xs text-slate-400 mt-1">Jl. Latumeten 1, RT.5/RW.5, Jelambar, Kec. Grogol petamburan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11460</p>
            <p class="text-xs text-slate-400">Telp: 0812-3456-7890</p>
        </div>

        <div class="space-y-2 border-b border-dashed border-slate-200 pb-4 mb-5 text-xs">
            <div class="flex justify-between">
                <span class="text-slate-400">No. Nota:</span>
                <span class="font-bold text-slate-800">#TRX-{{ $transaction->id_transaction }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Tanggal:</span>
                <span class="text-slate-600">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Pelanggan:</span>
                <span class="font-bold text-slate-800">{{ $transaction->customer_name }}</span>
            </div>
        </div>

        <div class="border-b border-dashed border-slate-200 pb-4 mb-5 space-y-3">
            <span class="block text-[11px] font-bold text-slate-400 tracking-wider uppercase">LAYANAN / ITEM</span>
            
            @foreach($transaction->details as $detail)
                <div class="flex justify-between items-start text-xs">
                    <div class="max-w-[65%]">
                        <span class="font-medium text-slate-800 block">{{ $detail->service->name }}</span>
                        <span class="text-[10px] text-slate-400 block mt-0.5">{{ $detail->quantity }}x @ Rp {{ number_format($detail->price_at_purchase, 0, ',', '.') }}</span>
                    </div>
                    <span class="text-slate-800 font-medium">Rp {{ number_format($detail->price_at_purchase * $detail->quantity, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>

       <div class="text-[13px] space-y-1.5 pt-4 text-slate-600 border-t border-dashed border-slate-200 mt-4">
            <div class="flex justify-between font-medium">
                <span>Total Tagihan:</span>
                <span class="text-slate-900 font-semibold">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</span>
            </div>
            
            <div class="flex justify-between font-medium">
                <span>Uang Tunai (Cash):</span>
                <span class="text-slate-900 font-semibold">
                    Rp {{ number_format($uangBayar, 0, ',', '.') }}
                </span>
            </div>

            <div class="flex justify-between font-bold text-slate-900 border-t border-slate-100 pt-1.5">
                <span>Kembalian:</span>
                <span class="text-emerald-600 text-base">
                    Rp {{ number_format(max(0, $uangKembalian), 0, ',', '.') }}
                </span>
            </div>
            
            <div class="flex justify-between text-[12px] pt-3 border-t border-slate-100 mt-2">
                <span>Status Pembayaran:</span>
                <span class="px-2 py-0.5 text-[11px] font-bold bg-emerald-50 text-emerald-600 rounded-md uppercase">
                    {{ $transaction->status ?? 'PAID' }}
                </span>
            </div>
        </div>
        
        <div class="text-center border-t border-dashed border-slate-200 pt-5 mt-5 text-[11px] text-slate-400 space-y-1">
            <p class="font-medium text-slate-600 flex items-center justify-center gap-1">
                Terima Kasih Atas Kunjungan Anda 
            </p>
            <p class="text-[10px] text-slate-400 italic">Layanan Cantik & Maksimal Hanya di Octa Salon</p>
        </div>
    </div>
</section>
@endsection