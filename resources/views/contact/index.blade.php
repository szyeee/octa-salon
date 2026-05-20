@extends('layouts.app')

@section('content')

<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-pink-500 via-rose-500 to-fuchsia-500"></div>

    <div class="absolute inset-y-0 right-0 w-[35%] opacity-20 hidden lg:block">
        <svg viewBox="0 0 500 500" class="h-full w-full">
            <path d="M250 100 C300 200, 400 200, 450 300" stroke="white" stroke-width="3" fill="none"/>
            <path d="M250 100 C200 200, 100 250, 120 380" stroke="white" stroke-width="3" fill="none"/>
            <path d="M300 120 C360 170, 420 220, 460 340" stroke="white" stroke-width="2" fill="none" opacity="0.7"/>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-24">
        <div class="max-w-3xl text-center mx-auto">
            <span class="inline-flex items-center rounded-full bg-white/15 px-5 py-2 text-sm font-medium text-white backdrop-blur">
                ✨ Contact Octa Salon
            </span>

            <h1 class="mt-6 text-5xl md:text-6xl font-extrabold leading-tight text-white">
                Get In Touch
            </h1>

            <p class="mt-5 text-lg leading-8 text-white/90">
                We're here to help you with your beauty needs.
            </p>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-10">
    <div class="grid lg:grid-cols-3 gap-6 items-stretch">
        <div class="rounded-[1.75rem] bg-white border border-pink-100 p-8 shadow-lg lg:col-span-1">
            <h2 class="text-2xl font-extrabold text-slate-900">
                Contact Information
            </h2>

            <div class="mt-8 space-y-7 text-slate-700">
                <div class="flex gap-4">
                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-pink-100 text-pink-600">📍</div>
                    <div>
                        <div class="font-semibold text-slate-900">Address</div>
                        <div class="mt-1 text-sm text-slate-500">Jakarta Barat, Indonesia</div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-pink-100 text-pink-600">📞</div>
                    <div>
                        <div class="font-semibold text-slate-900">Phone</div>
                        <div class="mt-1 text-sm text-slate-500">+62 812 3456 7890</div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-pink-100 text-pink-600">✉️</div>
                    <div>
                        <div class="font-semibold text-slate-900">Email</div>
                        <div class="mt-1 text-sm text-slate-500">octasalon@gmail.com</div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-pink-100 text-pink-600">🕘</div>
                    <div>
                        <div class="font-semibold text-slate-900">Opening Hours</div>
                        <div class="mt-1 text-sm text-slate-500">Monday - Sunday<br>09.00 - 20.00</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-[1.75rem] bg-white border border-pink-100 p-8 shadow-lg lg:col-span-1">
            <h2 class="text-2xl font-extrabold text-slate-900">
                Send Us a Message
            </h2>

            <form class="mt-8 space-y-4">
                <input type="text" placeholder="Your Name" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-pink-400 focus:bg-white">
                <input type="email" placeholder="Your Email" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-pink-400 focus:bg-white">
                <textarea rows="6" placeholder="Your Message" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-pink-400 focus:bg-white"></textarea>

                <button type="button" class="w-full rounded-2xl bg-gradient-to-r from-pink-500 to-rose-500 py-3 font-semibold text-white shadow-lg shadow-pink-200 hover:scale-[1.01] transition">
                    ✈ Send Message
                </button>
            </form>
        </div>

        <div class="rounded-[1.75rem] overflow-hidden shadow-xl lg:col-span-1 min-h-[520px]">
            <img
                src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=1200&q=80"
                class="h-full w-full object-cover"
                alt="Salon contact"
            >
        </div>
    </div>
</section>

@endsection