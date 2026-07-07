<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Submit Work: {{ $task->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <x-flash-messages />

                <p class="mb-2 text-gray-600">
                    Subject: <strong>{{ $task->subject->name }}</strong>
                </p>
                <p class="mb-6 text-gray-600">
                    Due: {{ $task->due_date?->format('M d, Y') ?? 'No due date' }}
                    @if ($isPastDue)
                        <span class="text-red-600 font-medium">(Past due)</span>
                    @endif
                </p>

                @if ($isPastDue)
                    <div class="p-4 bg-red-100 text-red-700 rounded mb-4">
                        The deadline for this task has passed. Submissions are closed.
                    </div>
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-[#1E2A45] text-white rounded hover:bg-[#1E2A45]">
                                ← Back to Dashboard
                    </a>

                    @if ($submission)
                        <div class="mt-4">
                            <h3 class="text-sm font-medium text-gray-700 mb-1">Your last submission</h3>
                            @if ($submission->content)
                                <p class="text-gray-700 whitespace-pre-line">{{ $submission->content }}</p>
                            @endif
                            @if ($submission->file_path)
                                <a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="text-indigo-600 hover:underline text-sm">
                                    {{ $submission->original_filename }}
                                </a>
                            @endif
                        </div>
                    @endif
                @else
                    <form action="{{ route('tasks.submissions.update', $task) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Your Answer / Notes</label>
                            <textarea name="content" id="content" rows="5"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('content', $submission->content ?? '') }}</textarea>
                            @error('content')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">Attach File (optional)</label>
                            <input type="file" name="file" id="file" class="mt-1 block w-full text-sm">
                            @error('file')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            @if ($submission && $submission->file_path)
                                <p class="text-sm text-gray-500 mt-1">
                                    Current file:
                                    <a href="{{ Storage::url($submission->file_path) }}" target="_blank" class="text-indigo-600 hover:underline">
                                        {{ $submission->original_filename }}
                                    </a>
                                </p>
                            @endif
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                Back to Dashboard
                            </a>
                            <button type="submit" class="px-4 py-2 bg-ink text-white rounded hover:bg-ink/80 transition">
                                {{ $submission ? 'Update Submission' : 'Submit Work' }}
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>