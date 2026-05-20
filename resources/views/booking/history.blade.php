@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-12">

    <h1 class="text-4xl font-extrabold text-slate-800">
        Booking History
    </h1>

    <p class="mt-3 text-slate-500">
        View all your salon appointments.
    </p>

    @if(session('success'))

        <div class="mt-6 rounded-2xl bg-green-100 px-5 py-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif

    <div class="mt-10 grid gap-6">

        @forelse($reservations as $reservation)

            <div class="rounded-[2rem] border border-pink-100 bg-white p-8 shadow-lg">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>

                        <div class="inline-flex rounded-full bg-pink-100 px-4 py-2 text-sm font-semibold text-pink-600">
                            {{ ucfirst($reservation->status) }}
                        </div>

                        <h2 class="mt-5 text-3xl font-bold text-slate-800">

                            {{ $reservation->service->name ?? 'Salon Service' }}

                        </h2>

                        <div class="mt-4 flex flex-wrap gap-6 text-slate-500">

                            <div>
                                📅 {{ $reservation->date }}
                            </div>

                            <div>
                                ⏰ {{ $reservation->time }}
                            </div>

                        </div>

                    </div>

                    <div class="rounded-3xl bg-pink-50 px-8 py-6">

                        <div class="text-sm text-slate-500">
                            Booking Status
                        </div>

                        <div class="mt-2 text-2xl font-bold text-pink-600">
                            {{ ucfirst($reservation->status) }}
                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="rounded-[2rem] bg-white p-16 text-center shadow-lg border border-pink-100">

                <div class="text-7xl">
                    ✨
                </div>

                <h2 class="mt-6 text-3xl font-bold text-slate-800">
                    No Booking Yet
                </h2>

                <p class="mt-3 text-slate-500">
                    Start booking your favorite salon treatment.
                </p>

            </div>

        @endforelse

    </div>

</section>

@endsection