@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-2xl px-6 py-10">

    <div class="border-b border-pink-100 pb-5 mb-8">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Add New Customer</h1>
        <p class="text-slate-500 text-sm mt-1">Create a new customer account for Octa Salon.</p>
    </div>

    <div class="rounded-[2rem] border border-pink-50 bg-white p-8 shadow-xl shadow-pink-100/40">
        <form action="/admin/customers" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Customer Name</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="e.g. Jane Doe"
                       class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="customer@example.com"
                       class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Phone Number</label>
                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="e.g. 08123456789"
                       class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                @error('nomor_telepon') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6 border-t border-slate-100 pt-5">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Account Password</label>
                <p class="text-xs text-slate-400 mb-3">Set a secure password for the new customer account.</p>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <input type="password" name="password" required placeholder="Password"
                               class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" required placeholder="Confirm Password"
                               class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                    </div>
                </div>
                @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-xl font-bold transition transform hover:-translate-y-0.5 shadow-sm shadow-pink-200">
                    Create Account
                </button>
                <a href="/admin/customers" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3 rounded-xl font-bold transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>
@endsection
