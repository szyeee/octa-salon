@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-2xl px-6 py-10">
    <div class="border-b border-pink-100 pb-5 mb-8">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Add Operational Slot</h1>
        <p class="text-slate-500 text-sm mt-1">Open a new salon booking time slot for customers.</p>
    </div>

    <div class="rounded-[2rem] border border-pink-50 bg-white p-8 shadow-xl shadow-pink-100/40">
        <form action="/admin/slot" method="POST" class="mt-8 space-y-6">
        @csrf

        <div>
            <label class="mb-2 block text-sm font-semibold text-slate-700">Operational Date</label>
            <input type="date" name="date" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white text-sm">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Start Time (Format 24H)</label>
                <input type="text" name="start_time" placeholder="08:00" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white text-sm">
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">End Time (Format 24H)</label>
                <input type="text" name="done_time" placeholder="09:00" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white text-sm">
            </div>
        </div>

        <div>
            <label class="mb-3 block text-sm font-semibold text-slate-700">Initial Status</label>
            <select name="status" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white text-sm font-medium text-slate-700">
                <option value="available">Available for Booking</option>
                <option value="blocked">Booked / Closed Early</option>
            </select>
        </div>

        <button type="submit" class="w-full rounded-2xl bg-pink-600 py-4 text-lg font-bold text-white shadow-xl shadow-pink-200 transition hover:scale-[1.02]">
            Create Slot Time
        </button>
    </form>
    </div>
</section>
@endsection
