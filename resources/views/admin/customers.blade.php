@extends('layouts.app')

@section('content')
<section class="mx-auto max-w-7xl px-6 py-10">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-pink-100 pb-5 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Manage Customers</h1>
            <p class="mt-2 text-slate-500 text-sm mb-4">List of all customers registered in the Octa Salon system.</p>
            <a href="{{ route('admin.customers.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all inline-flex items-center gap-1.5 text-sm transform hover:-translate-y-0.5">
                + add new customer
            </a>
        </div>
        <div>
            <span class="inline-flex items-center gap-2 rounded-2xl bg-pink-50 border border-pink-100 px-4 py-2 text-sm font-semibold text-pink-600 shadow-sm shadow-pink-100">
                Total: {{ $customers->count() }} Customers
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="mt-6 rounded-2xl bg-emerald-50 p-4 text-sm font-medium text-emerald-600 border border-emerald-100 flex items-center gap-2">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mt-6 rounded-2xl bg-rose-50 p-4 text-sm font-medium text-rose-600 border border-rose-100 flex items-center gap-2">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="mt-8 overflow-hidden rounded-2xl border border-pink-50 bg-white shadow-xl shadow-pink-100/40">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse border border-slate-200">
                <thead>
                    <tr class="bg-pink-200 text-slate-700 uppercase text-xs font-bold border-b border-slate-300">
                        <th class="px-6 py-4 border-r border-slate-200">No</th>
                        <th class="px-6 py-4 border-r border-slate-200">Customer Name</th>
                        <th class="px-6 py-4 border-r border-slate-200">Email</th>
                        <th class="px-6 py-4 border-r border-slate-200">Phone Number</th>
                        <th class="px-6 py-4 border-r border-slate-200">Join Date</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($customers as $index => $customer)
                        <tr class="hover:bg-pink-50/20 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-900">{{ $customer->nama }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $customer->email }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $customer->nomor_telepon ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $customer->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-2">

                                <a href="/admin/customers/{{ $customer->id }}/edit"
                                   class="rounded-xl border border-pink-200 bg-white px-3 py-2 text-xs font-semibold text-pink-600 hover:bg-pink-50 transition-all shadow-sm">
                                    Edit
                                </a>

                                <form action="/admin/customers/{{ $customer->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-xl bg-red-50 px-3 py-2 text-xs font-semibold text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-medium bg-slate-50/50">
                                <div class="text-3xl mb-2">📭</div>
                                No regular customers have registered at Octa Salon.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
