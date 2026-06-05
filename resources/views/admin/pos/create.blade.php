@extends('layouts.app')

@section('content')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<section class="mx-auto max-w-4xl px-6 py-10">
    <div class="mb-8">
        <a href="{{ route('admin.pos.index') }}" class="text-sm font-semibold text-pink-600 hover:text-pink-700">← Back to POS</a>
        <h1 class="text-3xl font-bold text-slate-900 mt-2">Walk-In Customer Input</h1>
        <p class="text-slate-500 mt-1">Record transactions directly for customers who come without a reservation.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-100 text-rose-600 text-sm font-medium">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-[2rem] border border-pink-100 shadow-xl p-8">
        <form method="POST" action="{{ route('admin.transactions.store') }}">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Walk-In Customer Name</label>
                <input type="text" name="customer_name" value="{{ old('customer_name') }}" required placeholder="e.g., Sisca" 
                       class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-pink-400 transition font-medium">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-4">Select Service</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($services as $service)
                        <label class="flex items-center gap-3 p-4 rounded-2xl border border-slate-100 hover:border-pink-200 cursor-pointer transition bg-slate-50/50">
                            <input type="checkbox" name="services[]" value="{{ $service->id_service }}" data-price="{{ $service->price }}" class="service-checkbox w-5 h-5 accent-pink-500">
                            <div>
                                <span class="block font-semibold text-slate-800 text-sm">{{ $service->name }}</span>
                                <span class="block text-xs font-bold text-pink-600 mt-0.5">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-6 bg-slate-50 p-4 rounded-xl border border-slate-100 flex justify-between items-center">
                <span class="text-sm font-bold text-slate-700">Total Bill Amount:</span>
                <span id="total-tagihan-display" class="text-xl font-black text-pink-600">Rp 0</span>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Cash Received (Amount Paid)</label>
                <div class="relative">
                    <span class="absolute left-4 top-3.5 font-bold text-slate-400 text-sm">Rp</span>
                    <input type="number" id="amount_paid" name="amount_paid" value="{{ old('amount_paid') }}" required placeholder="Enter cash amount received" 
                           class="w-full rounded-xl border border-slate-200 pl-11 pr-4 py-3 outline-none focus:border-pink-400 transition font-medium text-slate-800"
                           min="0">
                </div>
            </div>

            <div id="kembalian-block" class="mb-8 bg-emerald-50/50 p-4 rounded-xl border border-emerald-100 flex justify-between items-center hidden">
                <span class="text-sm font-bold text-emerald-800">Change Due:</span>
                <span id="kembalian-display" class="text-xl font-bold text-emerald-600">Rp 0</span>
            </div>

            <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-pink-500 to-rose-500 py-4 text-sm font-bold text-white shadow-lg shadow-pink-200 hover:opacity-90 transition">
                Save Walk-In Transaction & Print
            </button>
        </form>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.service-checkbox');
        const totalDisplay = document.getElementById('total-tagihan-display');
        const amountPaidInput = document.getElementById('amount_paid');
        const kembalianBlock = document.getElementById('kembalian-block');
        const kembalianDisplay = document.getElementById('kembalian-display');

        let totalTagihan = 0;

        // Fungsi untuk format Rupiah
        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Hitung total harga ketika checkbox dicentang/diubah
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                totalTagihan = 0;
                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        totalTagihan += parseInt(cb.getAttribute('data-price'));
                    }
                });
                
                totalDisplay.textContent = formatRupiah(totalTagihan);
                calculateChange();
            });
        });

        // Hitung kembalian ketika kasir mengetik nominal uang
        amountPaidInput.addEventListener('input', calculateChange);

        function calculateChange() {
            const uangBayar = parseInt(amountPaidInput.value) || 0;
            
            if (uangBayar > 0 && totalTagihan > 0) {
                const kembalian = uangBayar - totalTagihan;
                
                kembalianBlock.classList.remove('hidden');
                if (kembalian >= 0) {
                    kembalianDisplay.textContent = formatRupiah(kembalian);
                    kembalianDisplay.className = "text-xl font-bold text-emerald-600";
                } else {
                    // Jika uang tunai kurang, teks berubah merah sebagai peringatan
                    kembalianDisplay.textContent = "Insufficient Cash " + formatRupiah(Math.abs(kembalian));
                    kembalianDisplay.className = "text-xl font-bold text-rose-500";
                }
            } else {
                kembalianBlock.classList.add('hidden');
            }
        }
    });
</script>
@endsection