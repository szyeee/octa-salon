@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-10">
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Admin Dashboard</h1>
            <p class="mt-2 text-slate-500">Overall salon performance and statistics.</p>
        </div>
    </div>

    <!-- Top Statistics Cards -->
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

    <!-- Admin Control Panel Links -->
    <div class="mt-12">
        <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
            <!-- Icon: LayoutDashboard -->
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-pink-500"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
            Admin Control Panel
        </h3>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            <!-- Card 1: Manage Customers -->
            <a href="/admin/customers" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center group-hover:bg-pink-500 group-hover:text-white transition-all">
                    <!-- Icon: Users -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">Manage Customers</h4>
                <p class="mt-2 text-sm text-slate-500">View, edit, and manage data for all Octa Salon customers.</p>
            </a>

            <!-- Card 2: Manage Services -->
            <a href="/admin/services" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center group-hover:bg-purple-500 group-hover:text-white transition-all">
                    <!-- Icon: Scissors -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><circle cx="6" cy="18" r="3"/><path d="M9.8 14.2 14 10M12 12l8 8M20 4l-6 6"/></svg>
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">Manage Services</h4>
                <p class="mt-2 text-sm text-slate-500">Add services, set prices, and service duration.</p>
            </a>

            <!-- Card 3: Manage Slot Time -->
            <a href="{{ route('admin.slot.index') }}" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center group-hover:bg-sky-500 group-hover:text-white transition-all">
                    <!-- Icon: CalendarClock -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 0-9 9l.004-.003M21 17.5c0 1.38-1.13 2.5-2.5 2.5s-2.5-1.12-2.5-2.5 1.13-2.5 2.5-2.5 2.5 1.12 2.5 2.5z"/><path d="M12 7v5l2 2"/></svg>
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">Manage Slot Time</h4>
                <p class="mt-2 text-sm text-slate-500">Set operating hours, manage active session schedules, and block or open time availability for customer bookings.</p>
            </a>

            <!-- Card 4: Manage Appointments -->
            <a href="{{ route('admin.reservations.index') }}" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition-all">
                    <!-- Icon: CalendarCheck -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">Manage Appointments</h4>
                <p class="mt-2 text-sm text-slate-500">Monitor incoming booking schedules, confirm status, and check customer attendance.</p>
            </a>

            <!-- Card 5: POS Kasir & Walk-In -->
            <a href="{{ route('admin.pos.index') }}" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-all">
                    <!-- Icon: ReceiptCent -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z"/><path d="M12 7v6"/><path d="M10 8.5a2.5 2.5 0 1 0 4 2"/></svg>
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">POS Kasir & Walk-In</h4>
                <p class="mt-2 text-sm text-slate-500">Process payment for completed invoices, print receipts, and manually input walk-in customers.</p>
            </a>

            <!-- Card 6: Financial Reports -->
            <a href="{{ route('admin.report.index') }}" class="group rounded-[2rem] bg-white p-6 shadow-xl shadow-pink-100/50 border border-pink-50 hover:border-pink-300 transition-all hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center group-hover:bg-rose-500 group-hover:text-white transition-all">
                    <!-- Icon: TrendingUp -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                </div>
                <h4 class="mt-5 text-lg font-bold text-slate-800">Financial Reports</h4>
                <p class="mt-2 text-sm text-slate-500">Financial statistical analysis, profit charts, and net revenue history.</p>
            </a>

        </div>
    </div>
</section>
@endsection