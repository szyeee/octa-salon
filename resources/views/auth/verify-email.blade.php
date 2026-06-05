<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - Octa Salon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex items-center justify-center antialiased p-4">

    <div class="max-w-md w-full bg-white border border-slate-100 p-8 shadow-xl rounded-2xl text-center">
        
        <div class="mx-auto w-16 h-16 bg-pink-50 text-pink-500 rounded-2xl flex items-center justify-center mb-6 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke-currentColor="class w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
        </div>

        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Verify Your Email Address</h1>
        
        <p class="text-sm text-slate-500 mt-3 leading-relaxed">
            Thanks for signing up at <strong>Octa Salon</strong>! Before starting your reservation, please check your email inbox and click the verification link we just sent you.
        </p>

        @if (session('message'))
            <div class="mt-4 p-3 text-xs bg-emerald-50 text-emerald-700 rounded-xl font-medium border border-emerald-100">
                A fresh verification link has been sent to your email address!
            </div>
        @endif

        <div class="mt-8 space-y-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full px-5 py-3 text-sm font-semibold text-white bg-pink-500 hover:bg-pink-600 rounded-xl shadow-md transition-all duration-150 transform active:scale-[0.98]">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-5 py-2.5 text-xs font-bold text-slate-400 hover:text-slate-600 transition">
                    Log Out
                </button>
            </form>
        </div>

        <div class="mt-8 pt-4 border-t border-slate-100 text-[11px] text-slate-400">
            Didn't receive the email? Please check your <strong>Spam</strong> folder or click the resend button above.
        </div>

    </div>

</body>
</html>