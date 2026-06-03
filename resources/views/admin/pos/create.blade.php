@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-4xl px-6 py-10">
    <div class="mb-8">
        <a href="{{ route('admin.pos.index') }}" class="text-sm font-semibold text-pink-600 hover:text-pink-700">← Kembali ke Kasir</a>
        <h1 class="text-3xl font-bold text-slate-900 mt-2">Walk-In Customer Input</h1>
        <p class="text-slate-500 mt-1">Record transactions directly for customers who come without a reservation.</p>
    </div>

    <div class="bg-white rounded-[2rem] border border-pink-100 shadow-xl p-8">
        <form method="POST" action="{{ route('admin.transactions.store') }}">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-2">Walk-In Customer Name</label>
                <input type="text" name="customer_name" required placeholder="Contoh: Sisca" 
                       class="w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-pink-400 transition font-medium">
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-slate-700 mb-4">Select Service</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($services as $service)
                        <label class="flex items-center gap-3 p-4 rounded-2xl border border-slate-100 hover:border-pink-200 cursor-pointer transition bg-slate-50/50">
                            <input type="checkbox" name="services[]" value="{{ $service->id_service }}" class="w-5 h-5 accent-pink-500">
                            <div>
                                <span class="block font-semibold text-slate-800 text-sm">{{ $service->name }}</span>
                                <span class="block text-xs font-bold text-pink-600 mt-0.5">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-pink-500 to-rose-500 py-4 text-sm font-bold text-white shadow-lg shadow-pink-200 hover:opacity-90 transition">
                Save Walk-In Transaction
            </button>
        </form>
    </div>
</section>
@endsection