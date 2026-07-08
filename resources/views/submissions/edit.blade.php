<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-ink leading-tight">
            Submit Work: {{ $task->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-paper border border-slate/20 shadow-sm sm:rounded-lg p-6">

                <x-flash-messages />

                <p class="mb-1 text-sm text-slate uppercase tracking-wide">
                    Subject: <span class="text-ink font-semibold normal-case text-base">{{ $task->subject->name }}</span>
                </p>
                <p class="mb-6 text-sm text-slate">
                    Due: <span class="{{ $isPastDue ? 'text-marked font-medium' : 'text-ink' }}">
                        {{ $task->due_date?->format('M d, Y') ?? 'No due date' }}
                        @if ($isPastDue) (Past due) @endif
                    </span>
                </p>

                @if ($isPastDue)
                    <div class="p-4 bg-marked/10 text-marked border border-marked/30 rounded mb-4 text-sm">
                        The deadline for this task has passed. Submissions are closed.
                    </div>

                    <a href="{{ route('dashboard') }}"
                       class="inline-block px-4 py-2 text-sm bg-ink text-paper rounded hover:bg-gold transition-colors">
                        ← Back to Dashboard
                    </a>

                    @if ($submission)
                        <div class="mt-6 pt-4 border-t border-slate/10">
                            <h3 class="text-xs font-semibold uppercase tracking-wide text-slate mb-2">Your Last Submission</h3>
                            @if ($submission->content)
                                <p class="text-ink text-sm whitespace-pre-line">{{ $submission->content }}</p>
                            @endif
                            @if ($submission->file_path)
                                <a href="{{ Storage::url($submission->file_path) }}" target="_blank"
                                   class="text-gold hover:underline text-sm mt-2 inline-block">
                                    {{ $submission->original_filename }}
                                </a>
                            @endif
                        </div>
                    @endif
                @else
                    <form action="{{ route('tasks.submissions.update', $task) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-5">
                            <label for="content" class="block text-sm font-medium text-slate uppercase tracking-wide mb-1">Your Answer / Notes</label>
                            <textarea name="content" id="content" rows="5"
                                class="mt-1 block w-full border border-slate/30 rounded-md bg-paper text-ink px-3 py-2 text-sm focus:outline-none focus:border-gold">{{ old('content', $submission->content ?? '') }}</textarea>
                            @error('content')
                                <p class="text-marked text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="file" class="block text-sm font-medium text-slate uppercase tracking-wide mb-1">Attach File <span class="normal-case font-normal">(optional)</span></label>
                            <input type="file" name="file" id="file"
                                   class="mt-1 block w-full text-sm text-slate file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-sm file:bg-ink file:text-paper hover:file:bg-gold file:transition-colors">
                            @error('file')
                                <p class="text-marked text-sm mt-1">{{ $message }}</p>
                            @enderror

                            @if ($submission && $submission->file_path)
                                <p class="text-sm text-slate mt-2">
                                    Current file:
                                    <a href="{{ Storage::url($submission->file_path) }}" target="_blank"
                                       class="text-gold hover:underline">
                                        {{ $submission->original_filename }}
                                    </a>
                                </p>
                            @endif
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('dashboard') }}"
                               class="px-4 py-2 text-sm text-slate border border-slate/30 rounded hover:border-ink hover:text-ink transition-colors">
                                Back to Dashboard
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 text-sm bg-ink text-paper rounded hover:bg-gold transition-colors">
                                {{ $submission ? 'Update Submission' : 'Submit Work' }}
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>