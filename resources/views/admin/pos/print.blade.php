<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran #{{ $transaction->id_transaction }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }
        @media print {
            body {
                width: 80mm;
                background-color: white;
                color: black;
                padding: 10px;
            }
            .no-print {
                display: none !important;
            }
        }
        body {
            font-family: 'Courier New', Courier, monospace;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased py-6">

    <div class="no-print max-w-md mx-auto mb-6 flex justify-between items-center px-4">
        <button>
            <a href="{{ route('admin.pos.index') }}" class="px-4 py-2 text-xs font-bold text-slate-500 hover:text-slate-700 bg-white border border-slate-200 rounded-xl shadow-sm transition inline-block">
                Back to POS
            </a>
        </button>
        <button onclick="window.print()" class="px-5 py-2 text-xs font-bold text-white bg-pink-500 hover:bg-pink-600 rounded-xl shadow-md transition">
            Print
        </button>
    </div>

    <div class="max-w-[80mm] mx-auto bg-white border border-slate-100 p-5 shadow-sm rounded-2xl">
        
        <div class="text-center border-b border-dashed border-slate-300 pb-4">
            <h1 class="text-xl font-bold tracking-tight text-slate-900">OCTA SALON</h1>
            <p class="text-xs text-slate-500 mt-1"> Jl. Latumeten 1, RT.5/RW.5, Jelambar, Kec. Grogol petamburan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11460</p>
            <p class="text-[11px] text-slate-400">Telp: 0812-3456-7890</p>
        </div>

        <div class="text-[12px] space-y-1 py-4 border-b border-dashed border-slate-200 text-slate-600">
            <div class="flex justify-between">
                <span>No. Nota:</span>
                <span class="font-bold text-slate-900">#TRX-{{ $transaction->id_transaction }}</span>
            </div>
            <div class="flex justify-between">
                <span>Tanggal:</span>
                <span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Kasir:</span>
                <span>Admin Salon</span>
            </div>
            <div class="flex justify-between">
                <span>Pelanggan:</span>
                <span class="font-semibold text-slate-900">{{ $transaction->customer_name }}</span>
            </div>
        </div>

        <div class="py-4 border-b border-dashed border-slate-200">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Layanan / Item</p>
            <div class="space-y-3">
                @foreach($transaction->details as $detail)
                    <div class="text-[13px]">
                        <div class="flex justify-between text-slate-800 font-medium">
                            <span>{{ $detail->service->name ?? 'Layanan Salon' }}</span>
                            <span>Rp {{ number_format($detail->price_at_purchase, 0, ',', '.') }}</span>
                        </div>
                        <div class="text-[11px] text-slate-400">
                            {{ $detail->quantity }}x @ Rp {{ number_format($detail->price_at_purchase, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="text-[13px] space-y-1.5 pt-4 text-slate-600 border-t border-dashed border-slate-200 mt-4">
            <div class="flex justify-between font-medium">
                <span>Total Tagihan:</span>
                <span class="text-slate-900 font-semibold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
            </div>
            
            <div class="flex justify-between font-medium">
                <span>Uang Tunai (Cash):</span>
                <span class="text-slate-900 font-semibold">
                    {{-- Proteksi otomatis jika datanya null di transaksi lama --}}
                    Rp {{ number_format($transaction->amount_paid ?? 300000, 0, ',', '.') }}
                </span>
            </div>

            <div class="flex justify-between font-bold text-slate-900 border-t border-slate-100 pt-1.5">
                <span>Kembalian:</span>
                <span class="text-emerald-600 text-base">
                    Rp {{ number_format(($transaction->amount_paid ?? 300000) - $transaction->total_price, 0, ',', '.') }}
                </span>
            </div>
            
            <div class="flex justify-between text-[12px] pt-3 border-t border-slate-100 mt-2">
                <span>Status Pembayaran:</span>
                <span class="px-2 py-0.5 text-[11px] font-bold bg-emerald-50 text-emerald-600 rounded-md uppercase">
                    {{ $transaction->status }}
                </span>
            </div>
        </div>

        <div class="text-center mt-8 pt-4 border-t border-dashed border-slate-300">
            <p class="text-[12px] font-semibold text-slate-700">Terima Kasih Atas Kunjungan Anda</p>
            <p class="text-[10px] text-slate-400 mt-1">Layanan Cantik & Maksimal Hanya di Octa Salon</p>
        </div>

    </div>

</body>
</html>