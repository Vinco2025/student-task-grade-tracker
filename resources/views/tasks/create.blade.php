<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-ink leading-tight">
            New Task for {{ $subject->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-paper border border-slate/20 shadow-sm sm:rounded-lg p-6">
                <x-flash-messages />

                <form action="{{ route('subjects.tasks.store', $subject) }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label for="title" class="block text-sm font-medium text-slate uppercase tracking-wide mb-1">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="mt-1 block w-full border border-slate/30 rounded-md bg-paper text-ink px-3 py-2 text-sm focus:outline-none focus:border-gold">
                        @error('title')
                            <p class="text-marked text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="description" class="block text-sm font-medium text-slate uppercase tracking-wide mb-1">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full border border-slate/30 rounded-md bg-paper text-ink px-3 py-2 text-sm focus:outline-none focus:border-gold">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-marked text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="due_date" class="block text-sm font-medium text-slate uppercase tracking-wide mb-1">Due Date</label>
                        <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                            class="mt-1 block w-full border border-slate/30 rounded-md bg-paper text-ink px-3 py-2 text-sm focus:outline-none focus:border-gold">
                        @error('due_date')
                            <p class="text-marked text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('subjects.show', $subject) }}"
                           class="px-4 py-2 text-sm text-slate border border-slate/30 rounded hover:border-ink hover:text-ink transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-4 py-2 text-sm bg-ink text-paper rounded hover:bg-gold transition-colors">
                            Save Task
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>