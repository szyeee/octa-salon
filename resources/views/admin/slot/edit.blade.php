@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-2xl px-6 py-10">
    <div class="border-b border-pink-100 pb-5 mb-8">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Operational Slot</h1>
        <p class="text-slate-500 text-sm mt-1">Modify salon slot timings or status availability.</p>
    </div>

    <div class="rounded-[2rem] border border-pink-50 bg-white p-8 shadow-xl shadow-pink-100/40">
        <form action="{{ route('admin.slot.update', $slotTime->id_slot) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Operational Date</label>
                <input type="date" name="date" value="{{ old('date', $slotTime->date) }}" required
                       class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                @error('date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-4 sm:grid-cols-2 mb-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Start Time</label>
                    <input type="text" name="start_time" value="{{ old('start_time', \Carbon\Carbon::parse($slotTime->start_time)->format('H:i')) }}" required
                           class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                    @error('start_time') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">End Time</label>
                    <input type="text" name="done_time" value="{{ old('done_time', \Carbon\Carbon::parse($slotTime->done_time)->format('H:i')) }}" required
                           class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none transition">
                    @error('done_time') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6 pt-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Slot Availability Status</label>
                <select name="status" class="w-full rounded-2xl border border-pink-100 px-4 py-3 text-sm focus:border-pink-400 focus:outline-none bg-white transition">
                    <option value="available" {{ old('status', $slotTime->status) == 'available' ? 'selected' : '' }}>Available for Booking</option>
                    <option value="booked" {{ old('status', $slotTime->status) == 'booked' ? 'selected' : '' }}>Booked / Closed Early</option>
                </select>
                @error('status') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-50">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-xl font-bold transition transform hover:-translate-y-0.5 shadow-sm shadow-pink-200">
                    Update Slot
                </button>
                <a href="{{ route('admin.slot.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3 rounded-xl font-bold transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>
@endsection
