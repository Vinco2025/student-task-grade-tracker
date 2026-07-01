<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Subjects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            @if ($subjects->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-500">You haven't been assigned any subjects yet. Contact your admin to get assigned.</p>
                </div>
            @else
                @foreach ($subjects as $subject)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-lg font-semibold">{{ $subject->name }}</h3>
                            <a href="{{ route('subjects.show', $subject) }}" class="text-sm text-indigo-600 hover:underline">
                                View Subject
                            </a>
                        </div>

                        <p class="text-sm text-gray-500 mb-3">
                            {{ $subject->enrollments->count() }} student(s) enrolled
                        </p>

                        @if ($subject->tasks->isEmpty())
                            <p class="text-gray-500 text-sm">
                                No tasks created yet.
                                <a href="{{ route('subjects.tasks.create', $subject) }}" class="text-indigo-600 hover:underline">
                                    Add one
                                </a>.
                            </p>
                        @else
                            <ul class="divide-y">
                                @foreach ($subject->tasks->sortBy('due_date') as $task)
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">{{ $task->title }}</p>
                                            <p class="text-sm {{ $task->due_date && now()->startOfDay()->gt($task->due_date) ? 'text-red-500 font-medium' : 'text-gray-500' }}">
                                                Due: {{ $task->due_date?->format('M d, Y') ?? 'No due date' }}
                                                @if ($task->due_date && now()->startOfDay()->gt($task->due_date))
                                                    (Overdue)
                                                @endif
                                            </p>
                                        </div>
                                        <a href="{{ route('grades.edit', $task) }}" class="text-sm text-indigo-600 hover:underline">
                                            Grade
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</x-app-layout>