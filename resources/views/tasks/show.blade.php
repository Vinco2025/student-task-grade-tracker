<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-ink leading-tight">
            {{ $task->title }}
        </h2>
        <p class="text-sm text-slate mt-1">{{ $task->subject->name }}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-paper border border-slate/20 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">

                <x-flash-messages />

                {{-- Task meta --}}
                <div class="space-y-1">
                    @php $overdue = $task->due_date && now()->startOfDay()->gt($task->due_date); @endphp
                    <p class="text-sm text-slate">
                        Due:
                        <span class="{{ $overdue ? 'text-marked font-medium' : 'text-ink' }}">
                            {{ $task->due_date?->format('M d, Y') ?? 'No due date' }}
                            @if($overdue) (Overdue) @endif
                        </span>
                    </p>
                </div>

                {{-- Description --}}
                <div>
                    <h3 class="font-serif font-semibold text-ink mb-1">Description</h3>
                    <p class="text-slate text-sm">{{ $task->description ?? 'No description provided.' }}</p>
                </div>

                {{-- Grades section --}}
                <div>
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-serif font-semibold text-ink">Grades</h3>
                        @if(auth()->user()->role === 'teacher')
                            <a href="{{ route('grades.edit', $task) }}" class="text-sm text-gold hover:underline">
                                Grade this task
                            </a>
                        @endif
                    </div>

                    @if(in_array(auth()->user()->role, ['teacher', 'admin']))
                        <ul class="divide-y divide-slate/10">
                            @forelse ($task->grades as $grade)
                                <li class="py-2 flex justify-between items-center">
                                    <span class="text-sm text-ink">{{ $grade->student->name }}</span>
                                    <span class="text-sm text-slate">{{ $grade->score ?? 'Not graded' }}</span>
                                </li>
                            @empty
                                <li class="text-slate text-sm italic">No grades submitted yet.</li>
                            @endforelse
                        </ul>

                    @elseif(auth()->user()->role === 'student')
                        @php
                            $myGrade = $task->grades->firstWhere('student_id', auth()->id());
                            $passed  = $myGrade && $myGrade->score >= 50;
                        @endphp

                        @if($myGrade)
                            <div class="space-y-2">
                                <span class="inline-flex items-center text-xs font-semibold px-2 py-0.5 rounded-full border
                                    {{ $passed
                                        ? 'bg-approved/10 text-approved border-approved/30'
                                        : 'bg-marked/10 text-marked border-marked/30' }}">
                                    {{ $passed ? '✓ Passed' : '✗ Failed' }} — {{ $myGrade->score }}
                                </span>
                                @if($myGrade->feedback)
                                    <p class="text-sm text-slate italic">"{{ $myGrade->feedback }}"</p>
                                @endif
                            </div>
                        @else
                            <p class="text-slate text-sm italic">Not yet graded.</p>
                        @endif
                    @endif
                </div>

                {{-- Actions --}}
                <div class="flex justify-between items-center pt-2 border-t border-slate/10">
                    <a href="{{ route('subjects.show', $task->subject) }}"
                       class="text-sm text-slate hover:text-ink transition-colors">
                        ← Back to Subject
                    </a>

                    @if(in_array(auth()->user()->role, ['teacher', 'admin']))
                        <div class="flex gap-2">
                            <a href="{{ route('tasks.edit', $task) }}"
                               class="px-3 py-1.5 text-sm bg-ink text-paper rounded hover:bg-gold transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1.5 text-sm border border-marked text-marked rounded hover:bg-marked hover:text-paper transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>