<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-ink leading-tight">
            Grades for: {{ $task->title }}
        </h2>
        <p class="text-sm text-slate mt-1">{{ $task->subject->name }}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <x-flash-messages />

            @if ($errors->any())
                <div class="mb-4 p-4 bg-marked/10 text-marked border border-marked/30 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-paper border-l-4 border-gold overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($students->isEmpty())
                    <p class="text-slate">No students are enrolled in this subject yet.</p>
                @else
                    <form method="POST" action="{{ route('grades.update', $task) }}">
                        @csrf
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gold/30">
                                    <th class="py-2 px-3 text-sm font-semibold text-ink">Student</th>
                                    <th class="py-2 px-3 text-sm font-semibold text-ink">Submission</th>
                                    <th class="py-2 px-3 text-sm font-semibold text-ink w-28">Score</th>
                                    <th class="py-2 px-3 text-sm font-semibold text-ink">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    @php $submission = $submissions[$student->id] ?? null; @endphp
                                    <tr class="border-b border-gold/20 align-top">
                                        <td class="py-3 px-3">
                                            <p class="font-medium text-ink">{{ $student->name }}</p>
                                            <p class="text-sm text-slate">{{ $student->email }}</p>
                                        </td>
                                        <td class="py-3 px-3 text-sm text-slate max-w-xs">
                                            @if ($submission)
                                                @if ($submission->content)
                                                    <p class="line-clamp-3 whitespace-pre-line">{{ $submission->content }}</p>
                                                @endif
                                                @if ($submission->file_path)
                                                    <a href="{{ Storage::url($submission->file_path) }}" target="_blank"
                                                       class="text-gold hover:underline text-xs mt-1 inline-block">
                                                        {{ $submission->original_filename }}
                                                    </a>
                                                @endif
                                                <p class="text-xs text-slate/70 mt-1">
                                                    Submitted {{ $submission->submitted_at?->format('M d, Y g:i A') }}
                                                </p>
                                            @else
                                                <span class="text-slate italic">No submission</span>
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
                                                @if(!$submission) disabled @endif
                                                value="{{ old('scores.' . $student->id, $existingGrades[$student->id]->score ?? '') }}"
                                                class="w-24 rounded border-gold/30 bg-white shadow-sm focus:ring-gold focus:border-gold text-ink"
                                                placeholder="—"
                                            >
                                        </td>
                                        <td class="py-3 px-3">
                                            <textarea
                                                name="feedback[{{ $student->id }}]"
                                                @if(!$submission) disabled @endif
                                                rows="2"
                                                class="w-full rounded border-gold/30 bg-white shadow-sm focus:ring-gold focus:border-gold text-sm text-ink placeholder-slate/50 resize-none"
                                                placeholder="Optional feedback…"
                                            >{{ old('feedback.' . $student->id, $existingGrades[$student->id]->feedback ?? '') }}</textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6 flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-ink text-white rounded hover:bg-ink/80 transition text-sm font-medium">
                                Save Grades
                            </button>
                            <a href="{{ route('subjects.show', $task->subject_id) }}" class="text-sm text-slate hover:underline">
                                Cancel
                            </a>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>