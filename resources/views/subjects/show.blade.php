<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $subject->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p class="mb-4 text-gray-600">
                    Teacher: <strong>{{ $subject->teacher->name ?? 'Unassigned' }}</strong>
                </p>

                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-medium">Tasks</h3>
                    <a href="{{ route('subjects.tasks.create', $subject) }}" class="text-sm text-indigo-600 hover:underline">
                        + Add Task
                    </a>
                </div>
                <ul class="mb-6 list-disc list-inside">
                    @forelse ($subject->tasks as $task)
                        <li>
                            <a href="{{ route('tasks.show', $task) }}" class="text-indigo-600 hover:underline">
                                {{ $task->title }}
                            </a>
                            — Due: {{ $task->due_date ?? 'No due date' }}
                        </li>
                    @empty
                        <li class="text-gray-500">No tasks yet.</li>
                    @endforelse
                </ul>

                <h3 class="text-lg font-medium mb-2">Enrolled Students</h3>
                <ul class="mb-6 list-disc list-inside">
                    @forelse ($subject->enrollments as $enrollment)
                        <li>{{ $enrollment->student->name }}</li>
                    @empty
                        <li class="text-gray-500">No students enrolled yet.</li>
                    @endforelse
                </ul>

                <a href="{{ route('subjects.index') }}" class="text-indigo-600 hover:underline">
                    ← Back to Subjects
                </a>

            </div>
        </div>
    </div>
</x-app-layout>