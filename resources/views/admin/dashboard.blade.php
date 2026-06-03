@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-10">
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Admin Dashboard</h1>
            <p class="mt-2 text-slate-500">Overall salon performance and statistics.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 md:grid-cols-3">
        
        <a href="{{ route('admin.reservations.index') }}" class="group block rounded-[1.5rem] bg-white p-6 shadow-lg shadow-pink-100 border border-pink-50 hover:border-pink-300 hover:-translate-y-0.5 transition-all">
            <div class="text-sm text-slate-500 group-hover:text-pink-600 transition-colors font-medium flex items-center justify-between">
                <span>Reservations</span>
                <span class="text-xs text-slate-400 group-hover:text-pink-500 font-normal">View All &rarr;</span>
            </div>
            <div class="mt-3 text-4xl font-extrabold text-slate-900">{{ $totalReservations }}</div>
        </a>

        <a href="/admin/services" class="group block rounded-[1.5rem] bg-white p-6 shadow-lg shadow-pink-100 border border-pink-50 hover:border-pink-300 hover:-translate-y-0.5 transition-all">
            <div class="text-sm text-slate-500 group-hover:text-purple-600 transition-colors font-medium flex items-center justify-between">
                <span>Services</span>
                <span class="text-xs text-slate-400 group-hover:text-purple-500 font-normal">View All &rarr;</span>
            </div>
            <div class="mt-3 text-4xl font-extrabold text-slate-900">{{ $totalServices }}</div>
        </a>

        <a href="{{ route('admin.report.index') }}" class="group block rounded-[1.5rem] bg-gradient-to-br from-pink-500 to-rose-500 p-6 text-white shadow-lg shadow-pink-200 hover:opacity-95 hover:-translate-y-0.5 transition-all">
            <div class="text-sm text-white/80 font-medium flex items-center justify-between">
                <span>Total Revenue (All Time)</span>
                <span class="text-xs text-white/60 group-hover:text-white font-normal">View Reports &rarr;</span>
            </div>

            <div class="mt-3 text-4xl font-extrabold">
                Rp {{ number_format(\App\Models\Transaction::sum('total_price') ?? 0, 0, ',', '.') }}
            </div>
        </a>

    </div>

    <div class="mt-12">
        <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
            Admin Control Panel
        </h3>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            <a href="/admin/customers" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center text-2xl font-bold group-hover:bg-pink-500 group-hover:text-white transition-all">
                    👥
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">Manage Customers</h4>
                <p class="mt-2 text-sm text-slate-500">View, edit, and manage data for all Octa Salon customers.</p>
            </a>

            <a href="/admin/services" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-2xl font-bold group-hover:bg-purple-500 group-hover:text-white transition-all">
                    ✂️
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">Manage Services</h4>
                <p class="mt-2 text-sm text-slate-500">Add services, set prices, and service duration.</p>
            </a>

            <a href="{{ route('admin.slot.index') }}" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center text-2xl font-bold group-hover:bg-sky-500 group-hover:text-white transition-all">
                    ⏰
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">Manage Slot Time</h4>
                <p class="mt-2 text-sm text-slate-500">Set operating hours, manage active session schedules, and block or open time availability for customer bookings.</p>
            </a>

            <a href="{{ route('admin.reservations.index') }}" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl font-bold group-hover:bg-amber-500 group-hover:text-white transition-all">
                    📅
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">Manage Appointments</h4>
                <p class="mt-2 text-sm text-slate-500">Monitor incoming booking schedules, confirm status, and check customer attendance.</p>
            </a>

            <a href="{{ route('admin.pos.index') }}" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl font-bold group-hover:bg-emerald-500 group-hover:text-white transition-all">
                    🧾
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">POS Kasir & Walk-In</h4>
                <p class="mt-2 text-sm text-slate-500">Process payment for completed invoices, print receipts, and manually input walk-in customers.</p>
            </a>

            <a href="{{ route('admin.report.index') }}" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-2xl font-bold group-hover:bg-rose-500 group-hover:text-white transition-all">
                    💰
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">Financial Reports</h4>
                <p class="mt-2 text-sm text-slate-500">Financial statistical analysis, profit charts, and net revenue history.</p>
            </a>

        </div>
    </div>
</section>
@endsection
