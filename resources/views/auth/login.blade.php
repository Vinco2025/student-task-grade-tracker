<x-guest-layout>
    <div class="mb-6">
        <h1 class="font-serif text-3xl font-bold tracking-tight text-ink">Log in to your account</h1>
        <p class="mt-2 text-sm leading-6 text-slate">Pick up where you left off with your tasks and grades.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-semibold text-ink" />
            <x-text-input id="email"
                class="mt-1 block w-full rounded-xl border-ink/15 bg-white px-4 py-3 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-ink" />
            <div class="relative mt-1">
                <x-text-input id="password"
                    class="block w-full rounded-xl border-ink/15 bg-white px-4 py-3 pr-16 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />

                <button type="button"
                    data-toggle-password="password"
                    aria-pressed="false"
                    class="absolute inset-y-0 right-0 flex items-center rounded-r-xl border-l border-ink/10 px-3 text-xs font-semibold text-slate transition hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold">
                    Show
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-3 pt-1">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-ink/20 text-gold shadow-sm focus:ring-gold" name="remember">
                <span class="ms-2 text-sm text-slate">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-slate underline-offset-4 transition hover:text-ink hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <button type="submit"
            class="mt-2 inline-flex w-full items-center justify-center rounded-xl bg-ink px-4 py-3 text-sm font-semibold text-paper transition-colors duration-200 hover:bg-gold hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold">
            {{ __('Log in') }}
        </button>
    </form>

    @if (Route::has('register'))
        <p class="mt-6 text-center text-sm text-slate">
            New here?
            <a href="{{ route('register') }}" class="font-semibold text-ink underline-offset-4 hover:underline">Create an account</a>
        </p>
    @endif
</x-guest-layout>