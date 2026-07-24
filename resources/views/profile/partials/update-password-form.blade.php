<section class="space-y-6">
    <header>
        <h2 class="font-serif font-semibold text-lg text-ink">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-slate">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-sm font-semibold text-ink" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full rounded-xl border-ink/15 bg-white px-4 py-3 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-sm font-semibold text-ink" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full rounded-xl border-ink/15 bg-white px-4 py-3 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-sm font-semibold text-ink" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full rounded-xl border-ink/15 bg-white px-4 py-3 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="rounded-xl bg-ink px-4 py-3 text-sm font-semibold text-paper transition hover:bg-gold">
                {{ __('Save') }}
            </x-primary-button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-approved">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>