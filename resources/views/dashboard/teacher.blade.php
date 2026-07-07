<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-ink leading-tight">
            {{ __('My Subjects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            @if ($subjects->isEmpty())
                <div class="bg-paper border-l-4 border-gold overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-slate">You haven't been assigned any subjects yet. Contact your admin to get assigned.</p>
                </div>
            @else
                @foreach ($subjects as $subject)
                    <div class="bg-paper border-l-4 border-gold overflow-hidden shadow-sm sm:rounded-lg p-6">

                        <div class="flex justify-between items-center mb-1">
                            <h3 class="font-serif font-bold text-xl text-ink">{{ $subject->name }}</h3>
                            <a href="{{ route('subjects.show', $subject) }}" class="text-sm text-gold hover:underline">
                                View Subject
                            </a>
                        </div>

                        <p class="text-sm text-slate mb-4">
                            {{ $subject->enrollments->count() }} student(s) enrolled
                        </p>

                        <div class="border-t border-gold/20 pt-4">
                            @if ($subject->tasks->isEmpty())
                                <p class="text-slate text-sm">
                                    No tasks created yet.
                                    <a href="{{ route('subjects.tasks.create', $subject) }}" class="text-gold hover:underline">
                                        Add one
                                    </a>.
                                </p>
                            @else
                                <ul class="divide-y divide-gold/20">
                                    @foreach ($subject->tasks->sortBy('due_date') as $task)
                                        <li class="py-2 flex justify-between items-center">
                                            <div>
                                                <p class="font-medium text-ink">{{ $task->title }}</p>
                                                <p class="text-sm {{ $task->due_date && now()->startOfDay()->gt($task->due_date) ? 'text-marked font-medium' : 'text-slate' }}">
                                                    Due: {{ $task->due_date?->format('M d, Y') ?? 'No due date' }}
                                                    @if ($task->due_date && now()->startOfDay()->gt($task->due_date))
                                                        (Overdue)
                                                    @endif
                                                </p>
                                            </div>
                                            <a href="{{ route('grades.edit', $task) }}" class="text-sm text-gold hover:underline">
                                                Grade
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                    </div>
                @endforeach
            @endif

        </div>
    </div>
</x-app-layout>