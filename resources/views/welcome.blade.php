<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Student Tracker') }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}?v=2">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=fraunces:400,600,700|inter:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @keyframes board-in {
                from { opacity: 0; transform: translateY(14px); }
                to   { opacity: 1; transform: translateY(0); }
            }
            @media (prefers-reduced-motion: no-preference) {
                .board-in { animation: board-in 700ms cubic-bezier(.2,.7,.2,1) both; }
            }
        </style>
    </head>

    <body class="min-h-screen bg-[#1b2540] text-ink antialiased">
        @php
            // Optional: drop a real photo at public/images/classroom.jpg to replace the illustrated classroom.
            $photo = file_exists(public_path('images/classroom.jpg')) ? asset('images/classroom.jpg') : null;
        @endphp

        <div class="relative isolate flex min-h-screen flex-col overflow-hidden">

            {{-- ===== Classroom background ===== --}}
            <div class="absolute inset-0 -z-10" aria-hidden="true">
                @if ($photo)
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $photo }}')"></div>
                @else
                    <svg class="absolute inset-0 h-full w-full" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="wall" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#2d3656"/>
                                <stop offset="1" stop-color="#1b2540"/>
                            </linearGradient>
                            <linearGradient id="floor" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#7b5632"/>
                                <stop offset="1" stop-color="#34230f"/>
                            </linearGradient>
                            <linearGradient id="beam" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#ffd98a" stop-opacity=".42"/>
                                <stop offset="1" stop-color="#ffd98a" stop-opacity="0"/>
                            </linearGradient>
                            <linearGradient id="glass" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#ffe9b8"/>
                                <stop offset="1" stop-color="#f3c36b"/>
                            </linearGradient>

                            {{-- one desk + chair, origin = floor contact point --}}
                            <g id="desk">
                                <rect x="-30" y="-34" width="4" height="34" fill="#2a1c0f"/>
                                <rect x="26" y="-34" width="4" height="34" fill="#2a1c0f"/>
                                <rect x="-36" y="-46" width="72" height="8" rx="2" fill="#a06f3d"/>
                                <rect x="-32" y="-38" width="64" height="5" fill="#6b4727"/>
                                <rect x="-16" y="-22" width="32" height="5" rx="2" fill="#27355a"/>
                                <rect x="-13" y="-17" width="3" height="17" fill="#1a233f"/>
                                <rect x="10" y="-17" width="3" height="17" fill="#1a233f"/>
                            </g>
                        </defs>

                        {{-- wall + floor --}}
                        <rect width="1600" height="900" fill="url(#wall)"/>
                        <rect y="520" width="1600" height="380" fill="url(#floor)"/>
                        <rect y="506" width="1600" height="14" fill="#161d33"/>

                        {{-- floor boards --}}
                        <g stroke="#000" stroke-opacity=".16" stroke-width="2">
                            <line x1="0" y1="600" x2="1600" y2="600"/>
                            <line x1="0" y1="700" x2="1600" y2="700"/>
                            <line x1="0" y1="815" x2="1600" y2="815"/>
                        </g>

                        {{-- windows --}}
                        <g>
                            <rect x="110" y="80" width="230" height="300" fill="url(#glass)" stroke="#e8d9b5" stroke-width="8"/>
                            <line x1="225" y1="80" x2="225" y2="380" stroke="#e8d9b5" stroke-width="6"/>
                            <line x1="110" y1="230" x2="340" y2="230" stroke="#e8d9b5" stroke-width="6"/>

                            <rect x="1260" y="80" width="230" height="300" fill="url(#glass)" stroke="#e8d9b5" stroke-width="8"/>
                            <line x1="1375" y1="80" x2="1375" y2="380" stroke="#e8d9b5" stroke-width="6"/>
                            <line x1="1260" y1="230" x2="1490" y2="230" stroke="#e8d9b5" stroke-width="6"/>
                        </g>

                        {{-- light falling across the room --}}
                        <polygon points="110,380 340,380 640,900 190,900" fill="url(#beam)"/>
                        <polygon points="1260,380 1490,380 1410,900 960,900" fill="url(#beam)"/>

                        {{-- desks: back, middle, front rows --}}
                        <g opacity=".95">
                            <use href="#desk" transform="translate(120 575) scale(.8)"/>
                            <use href="#desk" transform="translate(330 575) scale(.8)"/>
                            <use href="#desk" transform="translate(540 575) scale(.8)"/>
                            <use href="#desk" transform="translate(750 575) scale(.8)"/>
                            <use href="#desk" transform="translate(960 575) scale(.8)"/>
                            <use href="#desk" transform="translate(1170 575) scale(.8)"/>
                            <use href="#desk" transform="translate(1380 575) scale(.8)"/>

                            <use href="#desk" transform="translate(60 690) scale(1.15)"/>
                            <use href="#desk" transform="translate(330 690) scale(1.15)"/>
                            <use href="#desk" transform="translate(600 690) scale(1.15)"/>
                            <use href="#desk" transform="translate(870 690) scale(1.15)"/>
                            <use href="#desk" transform="translate(1140 690) scale(1.15)"/>
                            <use href="#desk" transform="translate(1410 690) scale(1.15)"/>

                            <use href="#desk" transform="translate(150 840) scale(1.6)"/>
                            <use href="#desk" transform="translate(560 840) scale(1.6)"/>
                            <use href="#desk" transform="translate(970 840) scale(1.6)"/>
                            <use href="#desk" transform="translate(1380 840) scale(1.6)"/>
                        </g>
                    </svg>
                @endif

                {{-- keeps the foreground readable --}}
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(16,22,40,0.2),rgba(16,22,40,0.72))]"></div>
            </div>

            {{-- ===== Top bar ===== --}}
            <header class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 pt-6 sm:px-8 lg:px-12">
                <a href="{{ url('/') }}" class="font-serif text-xl font-semibold tracking-tight text-[#f4f0e6] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-gold">
                    {{ config('app.name', 'Student Tracker') }}
                </a>    
            </header>

            {{-- ===== Main ===== --}}
            <main class="mx-auto flex w-full max-w-6xl flex-1 flex-col justify-center px-6 py-10 sm:px-8 lg:px-12">

                {{-- The chalkboard --}}
                <section class="board-in rounded-[22px] bg-[#7a5230] p-3 shadow-[0_40px_90px_-30px_rgba(0,0,0,0.75)] sm:p-4" aria-labelledby="hero-title">
                    <div class="relative overflow-hidden rounded-2xl bg-[#1f3a34] px-6 py-10 shadow-[inset_0_2px_30px_rgba(0,0,0,0.55)] sm:px-10 sm:py-14 lg:px-14">

                        {{-- chalk dust --}}
                        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_20%_15%,rgba(255,255,255,0.07),transparent_45%),radial-gradient(ellipse_at_85%_80%,rgba(255,255,255,0.05),transparent_40%)]"></div>

                        <div class="relative grid items-center gap-10 lg:grid-cols-[1.4fr_0.6fr]">
                            <div>
                                <h1 id="hero-title" class="max-w-2xl font-serif text-4xl font-bold leading-[1.1] tracking-tight text-[#f4f0e6] sm:text-5xl lg:text-[3.4rem]">
                                    A cleaner way to manage learning, grading, and progress.
                                </h1>

                                <p class="mt-5 max-w-xl text-base leading-7 text-[#cfd9d3] sm:text-lg">
                                    Tasks, submissions, and grades for teachers, students, and admins, all in one organized workspace.
                                </p>

                                @if (Route::has('login'))
                                    <div class="mt-8 flex flex-wrap items-center gap-3">
                                        @auth
                                            <a href="{{ url('/dashboard') }}"
                                            class="inline-flex items-center rounded-full bg-gold px-6 py-3 text-sm font-semibold text-ink transition-colors duration-200 hover:bg-[#f4f0e6] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#f4f0e6]">
                                                Go to dashboard
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}"
                                            class="inline-flex items-center rounded-full bg-gold px-6 py-3 text-sm font-semibold text-ink transition-colors duration-200 hover:bg-[#f4f0e6] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#f4f0e6]">
                                                Log in
                                            </a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}"
                                                class="inline-flex items-center rounded-full border border-[#f4f0e6]/50 px-6 py-3 text-sm font-semibold text-[#f4f0e6] transition-colors duration-200 hover:bg-[#f4f0e6]/10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#f4f0e6]">
                                                    Create an account
                                                </a>
                                            @endif
                                        @endauth
                                    </div>
                                @endif
                            </div>

                            {{-- chalk-drawn grade --}}
                            <div class="hidden justify-center lg:flex" aria-hidden="true">
                                <svg viewBox="0 0 220 220" class="h-52 w-52 -rotate-6" fill="none" stroke="#f4f0e6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M110 22c52-4 92 30 90 82-2 56-46 92-98 90-54-2-84-40-82-88 2-44 34-76 82-82" stroke-width="5" opacity=".9"/>
                                    <text x="108" y="132" text-anchor="middle" font-family="Fraunces, serif" font-size="92" font-weight="700" fill="#f4f0e6" stroke="none">A+</text>
                                    <path d="M58 168c30 6 72 6 104-2" stroke="#c08a2e" stroke-width="4" opacity=".95"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- chalk tray --}}
                    <div class="mx-auto mt-3 h-2.5 w-[96%] rounded-full bg-[#5a3b20] shadow-[0_2px_0_rgba(255,255,255,0.08)_inset]"></div>
                </section>

                {{-- Roles --}}
                <section class="mt-8 grid gap-4 sm:grid-cols-3" aria-label="Who it's for">
                    <article class="relative rounded-xl bg-[#f6f2e8] px-5 pb-5 pt-7 shadow-[0_18px_40px_-20px_rgba(0,0,0,0.7)]">
                        <span class="absolute -top-2 left-5 h-4 w-16 rounded-sm bg-gold/90"></span>
                        <h2 class="font-serif text-xl font-semibold text-ink">Admin</h2>
                        <p class="mt-2 text-sm leading-6 text-slate">Manage subjects, assign teachers, enroll students, and oversee the whole system.</p>
                    </article>

                    <article class="relative rounded-xl bg-[#f6f2e8] px-5 pb-5 pt-7 shadow-[0_18px_40px_-20px_rgba(0,0,0,0.7)]">
                        <span class="absolute -top-2 left-5 h-4 w-16 rounded-sm bg-gold/90"></span>
                        <h2 class="font-serif text-xl font-semibold text-ink">Teacher</h2>
                        <p class="mt-2 text-sm leading-6 text-slate">Create tasks, review submissions, and keep grading organized.</p>
                    </article>

                    <article class="relative rounded-xl bg-[#f6f2e8] px-5 pb-5 pt-7 shadow-[0_18px_40px_-20px_rgba(0,0,0,0.7)]">
                        <span class="absolute -top-2 left-5 h-4 w-16 rounded-sm bg-gold/90"></span>
                        <h2 class="font-serif text-xl font-semibold text-ink">Student</h2>
                        <p class="mt-2 text-sm leading-6 text-slate">Track assignments, submit work, and watch your grades in one place.</p>
                    </article>
                </section>
            </main>

            <footer class="mx-auto w-full max-w-6xl px-6 pb-6 text-center text-xs text-[#f4f0e6]/70 sm:px-8 lg:px-12">
                Built with Laravel 12, PHP 8.2 and Tailwind CSS
            </footer>
        </div>
    </body>
</html>