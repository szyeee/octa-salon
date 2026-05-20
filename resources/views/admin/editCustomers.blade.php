@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-2xl px-6 py-10">

   <div class="mb-6">
        <a href="/admin/customers" class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-xs font-bold text-slate-600 shadow-sm hover:text-pink-600 transition-all">
            ⬅ Back to Customers
        </a>
    </div>

    <div class="border-b border-pink-100 pb-5 mb-8">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Customer</h1>
        <p class="text-slate-500 text-sm mt-1">Edit customer account information.</p>
    </div>



    <div class="rounded-[2rem] border border-pink-50 bg-white p-8 shadow-xl shadow-pink-100/40">
        <form action="/admin/customers/{{ $customer->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Customer Name</label>
                <input type="text" name="nama" value="{{ old('nama', $customer->nama) }}" required
                       class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $customer->email) }}" required
                       class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Phone Number</label>
                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $customer->nomor_telepon) }}"
                       class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                @error('nomor_telepon') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6 border-t border-slate-100 pt-5">
                <label class="block text-sm font-semibold text-slate-700 mb-1">New Password (Optional)</label>
                <p class="text-xs text-slate-400 mb-3">Leave blank if the customer does not want to change their password.</p>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <input type="password" name="password" placeholder="New Password"
                               class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password"
                               class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                    </div>
                </div>
                @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full rounded-2xl bg-gradient-to-r from-pink-500 to-rose-500 py-3.5 text-sm font-semibold text-white shadow-lg shadow-pink-200 hover:opacity-95 transition">
                Save Changes
            </button>
        </form>
    </div>
</section>
@endsection
