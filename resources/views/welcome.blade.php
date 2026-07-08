<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Student Tracker') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=fraunces:400,600,700|inter:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-paper text-ink antialiased min-h-screen flex flex-col items-center justify-center px-6">

        {{-- Logo / App name --}}
        <div class="mb-10 text-center">
            <h1 class="font-serif font-bold text-4xl text-ink tracking-tight">Student Tracker</h1>
            <p class="mt-2 text-slate text-sm">Task and grade management for teachers, students, and admins.</p>
        </div>

        {{-- Role feature cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-3xl w-full mb-10">
            <div class="bg-white border border-slate/20 rounded-lg p-5">
                <div class="w-1 h-6 bg-gold rounded-full mb-3"></div>
                <h3 class="font-serif font-semibold text-ink mb-1">Admin</h3>
                <p class="text-slate text-sm">Manage subjects, assign teachers, enroll students, and oversee the full system.</p>
            </div>
            <div class="bg-white border border-slate/20 rounded-lg p-5">
                <div class="w-1 h-6 bg-gold rounded-full mb-3"></div>
                <h3 class="font-serif font-semibold text-ink mb-1">Teacher</h3>
                <p class="text-slate text-sm">Create tasks, review submissions, and record grades with feedback per student.</p>
            </div>
            <div class="bg-white border border-slate/20 rounded-lg p-5">
                <div class="w-1 h-6 bg-gold rounded-full mb-3"></div>
                <h3 class="font-serif font-semibold text-ink mb-1">Student</h3>
                <p class="text-slate text-sm">Request enrollment, submit work before deadlines, and track your grades.</p>
            </div>
        </div>

        {{-- CTA buttons --}}
        @if (Route::has('login'))
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="px-5 py-2 bg-ink text-paper text-sm font-medium rounded hover:bg-gold transition-colors">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-5 py-2 bg-ink text-paper text-sm font-medium rounded hover:bg-gold transition-colors">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-5 py-2 text-sm text-slate border border-slate/30 rounded hover:border-ink hover:text-ink transition-colors">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif

        <p class="mt-10 text-xs text-slate/50">Built with Laravel 12 · PHP 8.2 · Tailwind CSS</p>

    </body>
</html>