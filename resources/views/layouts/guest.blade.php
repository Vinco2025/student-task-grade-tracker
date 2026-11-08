<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Student Tracker') }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}?v=2">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=fraunces:400,600,700|inter:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @keyframes card-in {
                from { opacity: 0; transform: translateY(14px); }
                to   { opacity: 1; transform: translateY(0); }
            }
            @media (prefers-reduced-motion: no-preference) {
                .card-in { animation: card-in 600ms cubic-bezier(.2,.7,.2,1) both; }
            }
        </style>
    </head>

    <body class="min-h-screen bg-[#1b2540] font-sans text-ink antialiased">
        <div class="relative isolate flex min-h-screen flex-col overflow-hidden">
            <x-classroom-bg />

            <header class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 pt-6 sm:px-8 lg:px-12">
                <a href="{{ url('/') }}" class="font-serif text-xl font-semibold tracking-tight text-[#f4f0e6] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold">
                    {{ config('app.name', 'Student Tracker') }}
                </a>
            </header>

            <main class="flex flex-1 items-center justify-center px-6 py-10">
                {{-- wooden frame around a paper notice --}}
                <div class="card-in w-full max-w-md rounded-[22px] bg-[#7a5230] p-3 shadow-[0_40px_90px_-30px_rgba(0,0,0,0.75)]">
                    <div class="relative rounded-2xl bg-[#f6f2e8] px-6 pb-8 pt-10 shadow-[inset_0_1px_0_rgba(255,255,255,0.7)] sm:px-8">
                        <span class="absolute -top-2 left-1/2 h-5 w-20 -translate-x-1/2 rounded-sm bg-gold/90" aria-hidden="true"></span>
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>

        <script>
            // Show/Hide for any password field: <button type="button" data-toggle-password="input-id">Show</button>
            document.querySelectorAll('[data-toggle-password]').forEach(function (button) {
                const input = document.getElementById(button.dataset.togglePassword);
                if (!input) return;

                button.addEventListener('click', function () {
                    const reveal = input.type === 'password';
                    input.type = reveal ? 'text' : 'password';
                    button.textContent = reveal ? 'Hide' : 'Show';
                    button.setAttribute('aria-pressed', String(reveal));
                });
            });
        </script>
    </body>
</html>