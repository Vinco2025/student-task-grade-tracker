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
    <body class="bg-paper text-ink antialiased min-h-screen">
        <div class="relative isolate min-h-screen overflow-hidden px-6 py-10 sm:px-8 lg:px-12">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(192,138,46,0.18),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(30,42,69,0.12),transparent_34%)]"></div>

            <div class="relative mx-auto flex min-h-[calc(100vh-5rem)] max-w-6xl items-center">
                <div class="w-full rounded-[32px] border border-ink/10 bg-white/90 p-6 shadow-[0_30px_80px_-35px_rgba(30,42,69,0.55)] backdrop-blur-sm sm:p-8 lg:p-12">
                    <div class="grid items-center gap-10 lg:grid-cols-[1.15fr_0.85fr]">
                        <div>
                            <h1 class="mt-5 max-w-xl font-serif text-4xl font-bold tracking-tight text-ink sm:text-5xl">
                                A cleaner way to manage learning, grading, and progress.
                            </h1>

                            <p class="mt-4 max-w-2xl text-base leading-7 text-slate sm:text-lg">
                                Task and grade management for teachers, students, and admins — all in one organized workspace built for clarity.
                            </p>

                            @if (Route::has('login'))
                                <div class="mt-8 flex flex-wrap items-center gap-3">
                                    @auth
                                        <a href="{{ url('/dashboard') }}"
                                        class="inline-flex items-center rounded-full bg-ink px-5 py-2.5 text-sm font-semibold text-paper transition-colors duration-200 hover:bg-gold">
                                            Go to Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                        class="inline-flex items-center rounded-full bg-ink px-5 py-2.5 text-sm font-semibold text-paper transition-colors duration-200 hover:bg-gold">
                                            Log in
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                            class="inline-flex items-center rounded-full border border-slate/30 px-5 py-2.5 text-sm font-semibold text-slate transition-colors duration-200 hover:border-ink hover:text-ink">
                                                Register
                                            </a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>

                        <div class="rounded-3xl border border-ink/10 bg-paper p-5 sm:p-6">
                            <div class="grid gap-4">
                                <div class="rounded-2xl border border-ink/10 bg-white p-4">
                                    <div class="mb-3 h-1.5 w-14 rounded-full bg-gold"></div>
                                    <h2 class="font-serif text-xl font-semibold text-ink">Admin</h2>
                                    <p class="mt-2 text-sm leading-6 text-slate">Manage subjects, assign teachers, enroll students, and oversee the full system with confidence.</p>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div class="rounded-2xl border border-ink/10 bg-white p-4">
                                        <div class="mb-3 h-1.5 w-14 rounded-full bg-gold"></div>
                                        <h2 class="font-serif text-lg font-semibold text-ink">Teacher</h2>
                                        <p class="mt-2 text-sm leading-6 text-slate">Create tasks, review submissions, and keep grading organized.</p>
                                    </div>

                                    <div class="rounded-2xl border border-ink/10 bg-white p-4">
                                        <div class="mb-3 h-1.5 w-14 rounded-full bg-gold"></div>
                                        <h2 class="font-serif text-lg font-semibold text-ink">Student</h2>
                                        <p class="mt-2 text-sm leading-6 text-slate">Track assignments, submit work, and monitor grades in one place.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col items-center justify-between gap-3 border-t border-ink/10 pt-5 text-center text-xs text-slate/70 sm:flex-row sm:text-left">
                        <p>Built with Laravel 12 · PHP 8.2 · Tailwind CSS</p>
                        <p class="font-medium text-ink/80">Designed around the existing Student Tracker palette.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>