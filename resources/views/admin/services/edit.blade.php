@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold text-slate-800 mb-6">Edit Service: {{ $service->name }}</h2>

    <form action="{{ route('admin.services.update', $service->id_service) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl border border-pink-100 shadow-sm space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-slate-700 font-semibold mb-2">Service Name</label>
            <input type="text" name="name" value="{{ $service->name }}" class="w-full border border-slate-200 rounded-xl p-3 focus:outline-none focus:border-pink-500" required>
        </div>
        <div>
            <label class="block text-slate-700 font-semibold mb-2">Description</label>
            <textarea name="description" rows="3" class="w-full border border-slate-200 rounded-xl p-3 focus:outline-none focus:border-pink-500" required>{{ $service->description }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-slate-700 font-semibold mb-2">Price (Rp)</label>
                <input type="number" name="price" value="{{ $service->price }}" class="w-full border border-slate-200 rounded-xl p-3 focus:outline-none focus:border-pink-500" required>
            </div>
            <div>
                <label class="block text-slate-700 font-semibold mb-2">Duration (Minutes)</label>
                <input type="number" name="duration" value="{{ $service->duration }}" class="w-full border border-slate-200 rounded-xl p-3 focus:outline-none focus:border-pink-500" required>
            </div>
        </div>
        <div>
            <label class="block text-slate-700 font-semibold mb-2">Change Image (Leave blank if not changing)</label>
            <input type="file" name="image" class="w-full text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
        </div>
        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-xl font-bold transition">Update</button>
            <a href="{{ route('admin.services.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-3 rounded-xl font-bold transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
