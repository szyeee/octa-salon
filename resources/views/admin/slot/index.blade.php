@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-3xl font-bold text-slate-800">Manage Slot Operational Times</h2>

        <a href="/admin/slot/create" class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all inline-flex items-center gap-1.5 text-sm transform hover:-translate-y-0.5">
            + Add New Slot Time
        </a>
    </div>

    <div class="mb-6">
        <p class="text-slate-500 text-sm m-0">Set salon operational hours and freeze times when the salon closes early.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm font-semibold shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4 text-sm font-semibold shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden">
        <table class="w-full text-left border-collapse border border-pink-100">
            <thead>
                <tr class="bg-pink-200 text-slate-700 uppercase text-xs font-bold border-b border-slate-300">
                    <th class="p-4 w-16 text-center border-r border-pink-200/60">No</th>
                    <th class="p-4 border-r border-pink-200/60">Date</th>
                    <th class="p-4 border-r border-pink-200/60">Start Time</th>
                    <th class="p-4 border-r border-pink-200/60">End Time</th>
                    <th class="p-4 border-r border-pink-200/60 text-center">Status</th>
                    <th class="p-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pink-100 text-slate-700">
                @forelse($slots as $index => $slot)
                <tr class="hover:bg-pink-50/20 transition-colors">
                    <td class="p-4 text-center border-r border-pink-100/70 text-slate-400 font-medium">
                        {{ $slots->firstItem() + $index }}
                    </td>
                    <td class="p-4 border-r border-pink-100/70 font-semibold text-slate-800">
                        {{ \Carbon\Carbon::parse($slot->date)->translatedFormat('d F Y') }}
                    </td>
                    <td class="p-4 border-r border-pink-100/70 text-slate-600 font-medium">
                        {{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }} WIB
                    </td>
                    <td class="p-4 border-r border-pink-100/70 text-slate-600 font-medium">
                        {{ \Carbon\Carbon::parse($slot->done_time)->format('H:i') }} WIB
                    </td>
                    <td class="p-4 border-r border-pink-100/70 text-center">
                        @if($slot->status === 'available')
                            <span class="bg-green-100 text-green-700 border border-green-200 px-3 py-1 rounded-full text-xs font-bold">
                                Available
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 border border-red-200 px-3 py-1 rounded-full text-xs font-bold">
                                Booked / Closed
                            </span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="/admin/slot/{{ $slot->id_slot }}/edit" class="inline-flex items-center justify-center rounded-xl border border-pink-200 bg-white px-4 py-2.5 text-sm font-semibold text-pink-600 shadow-sm transition-all hover:bg-pink-50">
                                Edit
                            </a>
                            <form action="/admin/slot/{{ $slot->id_slot }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus slot waktu ini?')" class="m-0 p-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-500 shadow-sm transition-all hover:bg-red-500 hover:text-white">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-slate-400">
                        Belum ada data slot waktu operasional salon yang diatur.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $slots->links() }}
    </div>
</div>
@endsection
