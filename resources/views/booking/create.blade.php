@extends('layouts.app')

@section('content')

<section class="max-w-6xl mx-auto px-6 py-14">

    <div class="grid lg:grid-cols-2 gap-10">

        <div class="overflow-hidden rounded-[2.5rem] border border-pink-100 bg-white shadow-xl">

            <img
                src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1200&q=80"
                class="h-80 w-full object-cover">

            <div class="p-8">

                <div class="inline-flex rounded-full bg-pink-100 px-4 py-2 text-sm font-semibold text-pink-600">

                    Premium Salon Service

                </div>

                <h1 class="mt-5 text-4xl font-extrabold text-slate-800">

                    {{ $service->name }}

                </h1>

                <p class="mt-5 leading-8 text-slate-500">

                    {{ $service->description }}

                </p>

                <div class="mt-8 flex items-center justify-between rounded-3xl bg-pink-50 p-6">

                    <div>

                        <div class="text-sm text-slate-500">
                            Price
                        </div>

                        <div class="mt-2 text-3xl font-extrabold text-pink-600">

                            Rp {{ number_format($service->price,0,',','.') }}

                        </div>

                    </div>

                    <div class="text-right">

                        <div class="text-sm text-slate-500">
                            Duration
                        </div>

                        <div class="mt-2 text-2xl font-bold text-slate-800">

                            {{ $service->duration }} Minutes

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="rounded-[2.5rem] border border-pink-100 bg-white p-8 shadow-xl">

            <h2 class="text-3xl font-extrabold text-slate-800">

                Book Appointment

            </h2>

            <p class="mt-3 text-slate-500">

                Select your preferred booking date and time.

            </p>

            @if($errors->any())

                <div class="mt-5 rounded-2xl bg-red-100 px-5 py-4 text-red-600">

                    {{ $errors->first() }}

                </div>

            @endif

            <form
                method="POST"
                action="/booking/store"
                class="mt-8 space-y-6">

                @csrf

                <input
                    type="hidden"
                    name="service_id"
                    value="{{ $service->id_service }}">

                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">

                        Booking Date

                    </label>

                    <input
                        type="date"
                        name="date"
                        min="{{ date('Y-m-d') }}"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white">

                </div>

                <div>

                    <label class="mb-3 block text-sm font-semibold text-slate-700">

                        Select Time

                    </label>

                    <select
                        name="time"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 outline-none focus:border-pink-400 focus:bg-white">

                        <option value="">Choose Time</option>

                        <option>10:00</option>
                        <option>11:00</option>
                        <option>12:00</option>
                        <option>13:00</option>
                        <option>14:00</option>
                        <option>15:00</option>
                        <option>16:00</option>
                        <option>17:00</option>
                        <option>18:00</option>
                        <option>19:00</option>
                        <option>20:00</option>

                    </select>

                </div>

                <button
                    class="w-full rounded-2xl bg-gradient-to-r from-pink-500 to-rose-500 py-4 text-lg font-bold text-white shadow-xl shadow-pink-200 transition hover:scale-[1.02]">

                    Confirm Booking

                </button>

            </form>

        </div>

    </div>

</section>

@endsection