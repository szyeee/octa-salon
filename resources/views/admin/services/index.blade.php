@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center border-b border-pink-100/50 pb-6 mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Manage Salon Services</h2>
            <p class="text-sm text-slate-500 mt-1">Manage the list of services, work duration, and salon treatment prices.</p>
            <div class="mt-3">
                <span class="inline-flex items-center gap-2 rounded-xl bg-pink-50 border border-pink-100 px-3 py-1.5 text-xs font-bold text-pink-600 shadow-sm shadow-pink-100/50">
                    Total: {{ method_exists($services, 'total') ? $services->total() : $services->count() }} Services
                </span>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto justify-start lg:justify-end">
            <form method="GET" action="{{ url()->current() }}" class="flex items-center gap-2 w-full sm:w-auto">
                <div class="relative w-full sm:w-auto">
                    <label class="sr-only">Search Service</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $search ?? '' }}"
                        placeholder="Search service name..."
                        class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm outline-none focus:border-pink-400 focus:bg-white text-slate-700 font-medium transition shadow-sm w-full sm:w-56">
                </div>
                
                <button type="submit" class="rounded-xl bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white shadow-md hover:bg-slate-700 transition">
                    Search
                </button>

                @if(request('search'))
                    <a href="{{ url()->current() }}" class="rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-500 hover:bg-slate-200 transition">
                        Reset
                    </a>
                @endif
            </form>

            <a href="{{ route('admin.services.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all inline-flex items-center gap-1.5 text-sm transform hover:-translate-y-0.5 w-full sm:w-auto justify-center">
                + Add New Service
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm font-semibold shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-pink-100 overflow-hidden">
        <table class="w-full text-left border-collapse border border-pink-100">
            <thead>
                <tr class="bg-pink-200 text-slate-700 uppercase text-xs font-bold border-b border-slate-300">
                    <th class="p-4 w-16 text-center border-r border-pink-200/60">No</th>
                    <th class="p-4 border-r border-pink-200/60">Image</th>
                    <th class="p-4 border-r border-pink-200/60">Service Name</th>
                    <th class="p-4 border-r border-pink-200/60">Duration</th>
                    <th class="p-4 border-r border-pink-200/60">Price</th>
                    <th class="p-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pink-100 text-slate-700">
                @forelse($services as $index => $service)
                <tr class="hover:bg-pink-50/20 transition-colors">
                    <td class="p-4 text-center border-r border-pink-100/70 text-slate-400 font-medium">
                        {{ $loop->iteration }}
                    </td>
                    <td class="p-4 border-r border-pink-100/70">
                        <img src="{{ str_starts_with($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" class="w-16 h-16 object-cover rounded-xl">
                    </td>
                    <td class="p-4 font-semibold border-r border-pink-100/70 text-slate-800">
                        {{ $service->name }}
                    </td>
                    <td class="p-4 border-r border-pink-100/70 text-slate-600 font-medium">
                        {{ $service->duration }} Minutes
                    </td>
                    <td class="p-4 border-r border-pink-100/70 text-slate-600 font-medium">
                        Rp {{ number_format($service->price, 0, ',', '.') }}
                    </td>
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
                @empty
                <tr>
                    <td colspan="6" class="p-12 text-center text-slate-400 font-medium">
                        <span class="text-3xl block mb-2"></span>
                        <p class="font-semibold text-slate-600 text-sm">service "{{ request('search') }}" not found.</p>
                        <p class="text-xs text-slate-400 mt-1">Try checking your search keyword spelling again.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection