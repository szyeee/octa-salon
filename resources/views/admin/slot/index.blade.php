@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center border-b border-pink-100/50 pb-6 mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Manage Slot Operational Times</h2>
            <p class="text-sm text-slate-500 mt-1">Set salon operational hours and freeze times when the salon closes early.</p>
        </div>
        
        <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto justify-start lg:justify-end">
            
            <form method="GET" action="{{ url()->current() }}" class="flex items-center gap-2 w-full sm:w-auto">
                <div class="relative w-full sm:w-auto">
                    <label class="sr-only">Search Date</label>
                    <input 
                        type="date" 
                        name="search_date" 
                        value="{{ $searchDate ?? '' }}"
                        class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm outline-none focus:border-pink-400 focus:bg-white text-slate-700 font-medium transition shadow-sm w-full sm:w-48">
                </div>
                
                <button type="submit" class="rounded-xl bg-slate-800 px-5 py-2 text-sm font-bold text-white shadow-md hover:bg-slate-700 transition">
                    Search
                </button>

                @if(request('search_date'))
                    <a href="{{ url()->current() }}" class="rounded-xl bg-slate-100 px-3 py-2 text-sm font-bold text-slate-500 hover:bg-slate-200 transition">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="bg-pink-50/60 border border-pink-100 rounded-2xl p-6 mb-8 shadow-sm">
        <div class="flex items-center gap-2 mb-4">
            <h3 class="text-xs font-bold text-pink-700 uppercase tracking-wider">Bulk Auto-Generate Operational Hours</h3>
        </div>
        
        <form action="{{ route('admin.slot.generate') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 items-end gap-4">
            @csrf
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-slate-600 uppercase">From Date</label>
                <input type="date" name="start_date" min="{{ date('Y-m-d') }}" required 
                    class="rounded-xl border border-pink-200 p-3 text-sm outline-none bg-white focus:border-pink-500 transition-all text-slate-700 font-medium">
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-slate-600 uppercase">Until Date</label>
                <input type="date" name="end_date" min="{{ date('Y-m-d') }}" required 
                    class="rounded-xl border border-pink-200 p-3 text-sm outline-none bg-white focus:border-pink-500 transition-all text-slate-700 font-medium">
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-slate-600 uppercase">Salon Opening Hours</label>
                <input type="text" name="start_time" placeholder="09:00" required 
                    class="rounded-xl border border-pink-200 p-3 text-sm outline-none bg-white focus:border-pink-500 transition-all text-slate-700 font-medium">
            </div>
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-slate-600 uppercase">Salon Closing Hours</label>
                <input type="text" name="done_time" placeholder="18:00" required 
                    class="rounded-xl border border-pink-200 p-3 text-sm outline-none bg-white focus:border-pink-500 transition-all text-slate-700 font-medium">
            </div>
            <div class="sm:col-span-2 lg:col-span-1">
                <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-xl transition duration-200 shadow-sm whitespace-nowrap">
                    Generate Schedule
                </button>
            </div>
        </form>
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
                    <th class="p-4 border-r border-pink-200/60">Operational Start</th>
                    <th class="p-4 border-r border-pink-200/60">Operational End</th>
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
                                Active / Open
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 border border-red-200 px-3 py-1 rounded-full text-xs font-bold">
                                Fully Booked / Closed
                            </span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="/admin/slot/{{ $slot->id_slot }}/edit" class="inline-flex items-center justify-center rounded-xl border border-pink-200 bg-white px-4 py-2.5 text-sm font-semibold text-pink-600 shadow-sm transition-all hover:bg-pink-50">
                                Edit
                            </a>
                            <form action="/admin/slot/{{ $slot->id_slot }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus jadwal tanggal ini?')" class="m-0 p-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-500 shadow-sm transition-all hover:bg-red-500 hover:text-white">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-12 text-center text-slate-400 font-medium">
                        No operating hours have been set. Specify the date and time above to create a new schedule!
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