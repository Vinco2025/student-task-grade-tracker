<x-guest-layout>
    <div class="mb-6">
        <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-gold">Sign in</p>
        <h2 class="mt-2 font-serif text-2xl font-bold text-ink">Log in to your account</h2>
        <p class="mt-2 text-sm leading-6 text-slate">Continue where you left off and manage your student workflow with ease.</p>
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
                    class="block w-full rounded-xl border-ink/15 bg-white px-4 py-3 pr-12 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />

                <button type="button"
                    id="toggle-password"
                    class="absolute inset-y-0 right-0 flex items-center rounded-r-xl border-l border-ink/10 px-3 text-xs font-semibold text-slate transition hover:text-ink">
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
                <a class="text-sm font-medium text-slate transition hover:text-ink" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center rounded-xl bg-ink px-4 py-3 text-sm font-semibold text-paper transition hover:bg-gold">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const togglePasswordButton = document.getElementById('toggle-password');

            if (passwordInput && togglePasswordButton) {
                togglePasswordButton.addEventListener('click', function () {
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';
                    togglePasswordButton.textContent = isPassword ? 'Hide' : 'Show';
                    togglePasswordButton.setAttribute('aria-pressed', String(isPassword));
                });
            }
        });
    </script>
</x-guest-layout>
