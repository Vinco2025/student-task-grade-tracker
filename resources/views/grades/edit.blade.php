<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Grades for: {{ $task->title }}
        </h2>
        <p class="text-sm text-gray-500">{{ $task->subject->name }}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <x-flash-messages />

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($students->isEmpty())
                    <p class="text-gray-500">No students are enrolled in this subject yet.</p>
                @else
                    <form method="POST" action="{{ route('grades.update', $task) }}">
                        @csrf
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2 px-3">Student</th>
                                    <th class="py-2 px-3">Submission</th>
                                    <th class="py-2 px-3 w-32">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    @php $submission = $submissions[$student->id] ?? null; @endphp
                                    <tr class="border-b align-top">
                                        <td class="py-3 px-3">
                                            <p class="font-medium">{{ $student->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $student->email }}</p>
                                        </td>
                                        <td class="py-3 px-3 text-sm text-gray-700 max-w-xs">
                                            @if ($submission)
                                                @if ($submission->content)
                                                    <p class="line-clamp-3 whitespace-pre-line">{{ $submission->content }}</p>
                                                @endif
                                                @if ($submission->file_path)
                                                    <a href="{{ Storage::url($submission->file_path) }}" target="_blank"
                                                        class="text-indigo-600 hover:underline text-xs mt-1 inline-block">
                                                        {{ $submission->original_filename }}
                                                    </a>
                                                @endif
                                                <p class="text-xs text-gray-400 mt-1">
                                                    Submitted {{ $submission->submitted_at?->format('M d, Y g:i A') }}
                                                </p>
                                            @else
                                                <span class="text-gray-400 italic">No submission</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-3">
                                            <input
                                                type="number"
                                                step="any"
                                                min="0"
                                                max="100"
                                                inputmode="decimal"
                                                name="scores[{{ $student->id }}]"
                                                value="{{ old('scores.' . $student->id, $existingGrades[$student->id]->score ?? '') }}"
                                                class="w-24 rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                                placeholder="—"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6 flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                Save Grades
                            </button>
                            <a href="{{ route('subjects.show', $task->subject_id) }}" class="text-gray-600 hover:underline">
                                Cancel
                            </a>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>