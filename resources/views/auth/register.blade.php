<x-guest-layout>
    <div class="mb-6">
        <h1 class="font-serif text-3xl font-bold tracking-tight text-ink">Create your account</h1>
        <p class="mt-2 text-sm leading-6 text-slate">Join as a student or teacher to manage tasks, submissions, and grades.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-sm font-semibold text-ink" />
            <x-text-input id="name"
                class="mt-1 block w-full rounded-xl border-ink/15 bg-white px-4 py-3 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold"
                type="text"
                name="name"
                :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-semibold text-ink" />
            <x-text-input id="email"
                class="mt-1 block w-full rounded-xl border-ink/15 bg-white px-4 py-3 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold"
                type="email"
                name="email"
                :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div>
            <x-input-label for="role" :value="__('I am a...')" class="text-sm font-semibold text-ink" />
            <select id="role" name="role" required
                class="mt-1 block w-full rounded-xl border-ink/15 bg-white px-4 py-3 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold">
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select your role</option>
                <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>Teacher</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-ink" />
            <div class="relative mt-1">
                <x-text-input id="password"
                    class="block w-full rounded-xl border-ink/15 bg-white px-4 py-3 pr-16 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />

                <button type="button"
                    data-toggle-password="password"
                    aria-pressed="false"
                    class="absolute inset-y-0 right-0 flex items-center rounded-r-xl border-l border-ink/10 px-3 text-xs font-semibold text-slate transition hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold">
                    Show
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-semibold text-ink" />
            <div class="relative mt-1">
                <x-text-input id="password_confirmation"
                    class="block w-full rounded-xl border-ink/15 bg-white px-4 py-3 pr-16 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold"
                    type="password"
                    name="password_confirmation"
                    required autocomplete="new-password" />

                <button type="button"
                    data-toggle-password="password_confirmation"
                    aria-pressed="false"
                    class="absolute inset-y-0 right-0 flex items-center rounded-r-xl border-l border-ink/10 px-3 text-xs font-semibold text-slate transition hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-gold">
                    Show
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit"
            class="mt-2 inline-flex w-full items-center justify-center rounded-xl bg-ink px-4 py-3 text-sm font-semibold text-paper transition-colors duration-200 hover:bg-gold hover:text-ink focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gold">
            {{ __('Create account') }}
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate">
        Already registered?
        <a href="{{ route('login') }}" class="font-semibold text-ink underline-offset-4 hover:underline">Log in</a>
    </p>
</x-guest-layout>