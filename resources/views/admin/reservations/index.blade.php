@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-800">Manage Appointments</h2>
        <p class="text-sm text-slate-500 mt-1">Monitor booking schedules, confirm status, and check customer attendance.</p>
    </div>

    @php $currentTab = request('tab', 'pending'); @endphp
    <div class="flex gap-4 mb-6 border-b border-slate-200 pb-px">
        <a href="?tab=pending" class="px-5 py-3 text-sm font-semibold border-b-2 transition-all {{ $currentTab == 'pending' ? 'border-pink-600 text-pink-600' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            Reservation Request <span class="ml-1.5 px-2 py-0.5 text-xs bg-pink-100 text-pink-700 rounded-full">{{ $pendingReservations->count() }}</span>
        </a>
        <a href="?tab=active" class="px-5 py-3 text-sm font-semibold border-b-2 transition-all {{ $currentTab == 'active' ? 'border-pink-600 text-pink-600' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            The Arrival of D-Day <span class="ml-1.5 px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded-full">{{ $activeReservations->count() }}</span>
        </a>
        <a href="?tab=history" class="px-5 py-3 text-sm font-semibold border-b-2 transition-all {{ $currentTab == 'history' ? 'border-pink-600 text-pink-600' : 'border-transparent text-slate-500 hover:text-slate-800' }}">
            Completed History <span class="ml-1.5 px-2 py-0.5 text-xs bg-slate-100 text-slate-700 rounded-full">{{ $historyReservations->count() }}</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-pink-200 text-slate-700 uppercase text-xs font-bold border-b border-slate-300">
                    <th class="p-4 border-r border-slate-200">No</th>
                    <th class="p-4 border-r border-slate-200">Customer</th>
                    <th class="p-4 border-r border-slate-200">Salon Services</th>
                    <th class="p-4 border-r border-slate-200">Booking Schedule</th>
                    <th class="p-4 border-r border-slate-200">Flow Status</th>
                    <th class="p-4 text-center">Admin Operational Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">

                @php
                    if($currentTab == 'active') { $dataLoop = $activeReservations; }
                    elseif($currentTab == 'history') { $dataLoop = $historyReservations; }
                    else { $dataLoop = $pendingReservations; }
                @endphp

                @forelse($dataLoop as $index => $res)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="p-4 font-medium text-slate-400">{{ $index + 1 }}</td>

                    <td class="p-4">
                        <div class="font-bold text-slate-800">{{ $res->user->nama ?? 'Customer #'.$res->id_user }}</div>
                        <div class="text-xs text-slate-400">ID User: {{ $res->id_user }}</div>
                    </td>

                    <td class="p-4">
                        <span class="px-2.5 py-1 text-xs font-semibold bg-pink-100 text-pink-700 rounded-full">
                            {{ $res->service->name ?? 'Service ID: '.$res->id_service }}
                        </span>
                    </td>

                    <td class="p-4">
                        <div class="font-semibold text-slate-700">
                            {{ isset($res->date) ? \Carbon\Carbon::parse($res->date)->format('d M Y') : 'Tanggal Kosong' }}
                        </div>
                        <div class="text-xs text-slate-400">
                            {{ isset($res->time) ? \Carbon\Carbon::parse($res->time)->format('H:i') : 'Jam Kosong' }} WIB
                        </div>
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 text-xs font-bold uppercase rounded-full
                            {{ $res->status == 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ $res->status == 'confirmed' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $res->status == 'arrived' ? 'bg-purple-100 text-purple-700' : '' }}
                            {{ $res->status == 'absent' ? 'bg-indigo-100 text-indigo-700' : '' }}
                            {{ $res->status == 'done' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $res->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                        ">
                            {{ $res->status ?? 'pending' }}
                        </span>
                    </td>

                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">

                            @if($currentTab == 'history' || in_array($res->status, ['done', 'absent', 'cancelled']))
                                <select disabled class="rounded-xl border border-slate-200 bg-slate-100 px-3 py-2 text-xs font-medium text-slate-400 outline-none cursor-not-allowed">
                                    <option selected class="uppercase">{{ $res->status }}</option>
                                </select>
                            @else
                                <form action="/admin/reservations/{{ $res->id_reservation }}/update-status" method="POST" class="inline-flex gap-1">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status_alur" onchange="this.form.submit()" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-medium outline-none focus:border-pink-400">

                                        @if($currentTab == 'pending')
                                            <option value="pending" {{ $res->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $res->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="cancelled" {{ $res->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>

                                        @elseif($currentTab == 'active')
                                            <option value="confirmed" {{ $res->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="arrived" {{ $res->status == 'arrived' ? 'selected' : '' }}>Arrived</option>
                                            <option value="absent" {{ $res->status == 'absent' ? 'selected' : '' }}>Absent</option>
                                            <option value="cancelled" {{ $res->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="done" {{ $res->status == 'done' ? 'selected' : '' }}>Done (Lunas)</option>
                                        @endif

                                    </select>
                                </form>
                            @endif

                            <form action="/admin/reservations/{{ $res->id_reservation }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data reservasi ini?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl bg-red-50 px-3 py-2 text-xs font-semibold text-red-500 hover:bg-red-100 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-12 text-center text-slate-400 font-medium">
                        There is no reservation data in this tab.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection
