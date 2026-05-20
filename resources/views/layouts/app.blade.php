{{-- resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Octa Salon</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        body{
            font-family: 'Poppins', sans-serif;
        }

    </style>

</head>

<body class="bg-[#fff7fb] text-slate-800 min-h-screen">

<header class="sticky top-0 z-50 border-b border-pink-100 bg-white/90 backdrop-blur-xl shadow-sm">

    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <a href="{{ Auth::check() && Auth::user()->is_admin ? '/admin/dashboard' : '/home' }}" class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-white font-bold shadow-lg shadow-pink-200">

                ✦

            </div>

            <div>

                <h1 class="text-xl font-extrabold text-slate-900 tracking-wide">
                    Octa Salon
                </h1>

                <p class="text-xs text-slate-500">
                    Professional Beauty Salon
                </p>

            </div>

        </a>

        <nav class="flex items-center gap-6">

            @if(Auth::check() && Auth::user()->is_admin)

                <div class="hidden lg:flex items-center gap-5 border-r border-slate-200 pr-5">
                    <a href="/admin/dashboard" class="text-sm font-medium text-pink-600 font-semibold' : 'text-slate-600 hover:text-pink-600' }} transition">
                        Dashboard
                    </a>
                    <a href="/admin/customers" class="text-sm font-medium {{ Request::is('admin/customers*') ? 'text-pink-600 font-semibold' : 'text-slate-600 hover:text-pink-600' }} transition">
                        Customers
                    </a>
                    <a href="/admin/services" class="text-sm font-medium {{ Request::is('admin/services*') ? 'text-pink-600 font-semibold' : 'text-slate-600 hover:text-pink-600' }} transition">
                        Services
                    </a>
                    <a href="/admin/slot" class="text-sm font-medium {{ Request::is('admin/slot*') ? 'text-pink-600 font-semibold' : 'text-slate-600 hover:text-pink-600' }} transition">
                        Slots
                    </a>
                    <a href="/admin/reservations" class="text-sm font-medium {{ Request::is('admin/reservations*') ? 'text-pink-600 font-semibold' : 'text-slate-600 hover:text-pink-600' }} transition">
                        Reservations
                    </a>
                    <a href="/admin/reports" class="text-sm font-medium {{ Request::is('admin/reports*') ? 'text-pink-600 font-semibold' : 'text-slate-600 hover:text-pink-600' }} transition">
                        Reports
                    </a>
                </div>

            @else
                <a href="/home"
                class="text-sm font-medium text-slate-700 hover:text-pink-600 transition">
                    Home
                </a>

                <a href="/services"
                class="text-sm font-medium text-slate-700 hover:text-pink-600 transition">
                    Services
                </a>

                <a href="/gallery"
                class="text-sm font-medium text-slate-700 hover:text-pink-600 transition">
                    Gallery
                </a>

                <a href="/about"
                class="text-sm font-medium text-slate-700 hover:text-pink-600 transition">
                    About
                </a>

                <a href="/contact"
                class="text-sm font-medium text-slate-700 hover:text-pink-600 transition">
                    Contact
                </a>

                @auth

                    <a href="/appointments"
                    class="text-sm font-medium text-slate-700 hover:text-pink-600 transition">
                        Booking
                    </a>
                @endauth
            @endif

            @auth
                <div class="relative">

                    <button
                        onclick="toggleProfileMenu()"
                        class="flex items-center gap-3 rounded-full border border-pink-100 bg-white px-3 py-2 shadow-sm hover:shadow-lg transition-all">

                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center text-white font-bold">

                            {{ strtoupper(substr(Auth::user()->nama,0,1)) }}

                        </div>

                        <div class="hidden md:block text-left">

                            <div class="text-sm font-semibold text-slate-800">

                                {{ Auth::user()->nama }}

                            </div>

                            <div class="text-xs text-slate-500">

                                {{ Auth::user()->is_admin ? 'Admin' : 'Customer' }}

                            </div>

                        </div>

                    </button>

                    <div
                        id="profileMenu"
                        class="hidden absolute right-0 mt-3 w-64 overflow-hidden rounded-3xl border border-pink-100 bg-white shadow-2xl z-50">

                        <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-6 py-5 text-white">

                            <div class="flex items-center gap-4">

                                <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center text-xl font-bold backdrop-blur">

                                    {{ strtoupper(substr(Auth::user()->nama,0,1)) }}

                                </div>

                                <div>

                                    <div class="font-bold text-lg">

                                        {{ Auth::user()->nama }}

                                    </div>

                                    <div class="text-sm text-white/90">

                                        {{ Auth::user()->email }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="p-2">

                            <a href="/profile"
                            class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-pink-50 transition">

                                👤 Edit Profile

                            </a>

                            <form method="POST" action="/logout">

                                @csrf

                                <button
                                    class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-red-500 hover:bg-red-50 transition">

                                    🚪 Logout

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @else

                <a href="/login"
                class="rounded-full border border-pink-200 px-5 py-2 text-sm font-semibold text-pink-600 hover:bg-pink-50 transition">

                    Login

                </a>

                <a href="/register"
                class="rounded-full bg-gradient-to-r from-pink-500 to-rose-500 px-5 py-2 text-sm font-semibold text-white shadow-lg shadow-pink-200 hover:scale-[1.03] transition">

                    Register

                </a>

            @endauth

        </nav>

    </div>

</header>

<main>

    @yield('content')

</main>

<script>

function toggleProfileMenu() {

    const menu = document.getElementById('profileMenu');

    menu.classList.toggle('hidden');

}

window.addEventListener('click', function(e){

    const menu = document.getElementById('profileMenu');

    if (
        !e.target.closest('#profileMenu') &&
        !e.target.closest('button')
    ) {

        menu.classList.add('hidden');

    }

});

</script>

</body>

</html>
