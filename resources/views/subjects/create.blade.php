<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-ink leading-tight">
            Create Subject
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-paper border border-slate/20 shadow-sm sm:rounded-lg p-6">
                <x-flash-messages />

                <form action="{{ route('subjects.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-slate uppercase tracking-wide mb-1">Subject Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="mt-1 block w-full border border-slate/30 rounded-md bg-paper text-ink px-3 py-2 text-sm focus:outline-none focus:border-gold">
                        @error('name')
                            <p class="text-marked text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="teacher_id" class="block text-sm font-medium text-slate uppercase tracking-wide mb-1">Teacher</label>
                        <select name="teacher_id" id="teacher_id"
                            class="mt-1 block w-full border border-slate/30 rounded-md bg-paper text-ink px-3 py-2 text-sm focus:outline-none focus:border-gold">
                            <option value="" disabled selected>Select a teacher</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <p class="text-marked text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('subjects.index') }}"
                           class="px-4 py-2 text-sm text-slate border border-slate/30 rounded hover:border-ink hover:text-ink transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-4 py-2 text-sm bg-ink text-paper rounded hover:bg-gold transition-colors">
                            Save Subject
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>