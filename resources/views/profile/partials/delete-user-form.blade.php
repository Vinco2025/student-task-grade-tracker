<section class="space-y-6">
    <header>
        <h2 class="font-serif font-semibold text-lg text-ink">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-slate">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-xl bg-marked px-4 py-3 text-sm font-semibold text-paper transition hover:bg-ink"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="font-serif font-semibold text-lg text-ink">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>
            <p class="mt-1 text-sm text-slate">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only text-sm font-semibold text-ink" />
                <x-text-input id="password" name="password" type="password"
                    class="mt-1 block w-full rounded-xl border-ink/15 bg-white px-4 py-3 text-sm text-ink shadow-sm transition focus:border-gold focus:ring-gold" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-xl border-ink/15 px-4 py-3 text-sm font-semibold text-slate transition hover:border-gold hover:text-ink">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-danger-button class="rounded-xl bg-marked px-4 py-3 text-sm font-semibold text-paper transition hover:bg-ink">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>