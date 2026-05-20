@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-slate-800">Manage Salon Services</h2>
        <a href="{{ route('admin.services.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2.5 rounded-full font-semibold shadow transition">
            + Add New Service
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left border-collapse border border-slate-200">
        <thead>
            <tr class="bg-pink-200 text-slate-700 uppercase text-xs font-bold border-b border-slate-300">
                <th class="p-4 border-r border-slate-200">Image</th>
                <th class="p-4 border-r border-slate-200">Service Name</th>
                <th class="p-4 border-r border-slate-200">Duration</th>
                <th class="p-4 border-r border-slate-200">Price</th>
                <th class="p-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 text-slate-700">
            @foreach($services as $service)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="p-4 border-r border-slate-200">
                    <img src="{{ str_starts_with($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" class="w-16 h-16 object-cover rounded-xl">
                </td>
                <td class="p-4 font-semibold border-r border-slate-200 text-slate-800">{{ $service->name }}</td>
                <td class="p-4 border-r border-slate-200">{{ $service->duration }} Minutes</td>
                <td class="p-4 border-r border-slate-200 font-medium">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                <td class="p-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('admin.services.edit', $service->id_service) }}" class="inline-flex items-center justify-center rounded-xl border border-pink-200 bg-white px-4 py-2.5 text-sm font-semibold text-pink-600 shadow-sm transition-all hover:bg-pink-50">
                            Edit
                        </a>
                        <form action="{{ route('admin.services.destroy', $service->id_service) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')" class="m-0 p-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-500 shadow-sm transition-all hover:bg-red-500 hover:text-white">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
