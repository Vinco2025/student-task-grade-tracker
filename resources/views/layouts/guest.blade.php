<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=fraunces:400,600,700|inter:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-ink antialiased bg-paper">
        <div class="relative min-h-screen overflow-hidden px-4 py-8 sm:px-6 lg:px-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(192,138,46,0.16),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(30,42,69,0.12),transparent_34%)]"></div>

            <div class="relative mx-auto flex min-h-[calc(100vh-4rem)] max-w-5xl items-center justify-center">
                <div class="grid w-full overflow-hidden rounded-[30px] border border-ink/10 bg-white/90 shadow-[0_30px_80px_-35px_rgba(30,42,69,0.55)] backdrop-blur-sm lg:grid-cols-[1fr_420px]">
                    <div class="hidden bg-ink px-8 py-10 text-paper lg:flex lg:flex-col lg:justify-between">
                        <div>
                            <h1 class="font-serif text-3xl font-bold leading-tight">
                                Welcome back to your learning workspace.
                            </h1>
                            <p class="mt-4 max-w-sm text-sm leading-6 text-paper/80">
                                Access your tasks, submissions, and grade updates in one centered system built for clarity.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-paper/15 bg-paper/5 p-4 text-sm text-paper/80">
                            Keep your records organized, your deadlines visible, and your progress transparent.
                        </div>
                    </div>

                    <div class="px-5 py-6 sm:px-8 sm:py-8">
                        <div class="mb-6 flex justify-center lg:hidden">
                            <a href="/">
                                <x-application-logo class="h-16 w-16 fill-current text-ink" />
                            </a>
                        </div>

                        <div class="w-full rounded-[24px] border border-ink/10 bg-paper p-4 sm:p-6">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
