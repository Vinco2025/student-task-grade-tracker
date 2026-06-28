<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $subject->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
                @endif

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
                            <a href="{{ route('grades.edit', $task) }}" class="ml-2 text-sm text-green-600 hover:underline">
                                Grade
                            </a>
                        </li>
                    @empty
                        <li class="text-gray-500">No tasks yet.</li>
                    @endforelse
                </ul>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Enrolled Students</h3>

                    @if ($subject->enrollments->isEmpty())
                        <p class="text-gray-500">No students enrolled yet.</p>
                    @else
                        <ul class="mb-4">
                            @foreach ($subject->enrollments as $enrollment)
                                <li class="flex items-center justify-between border-b py-2">
                                    <span>{{ $enrollment->student->name }}</span>

                                    <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" onsubmit="return confirm('Remove this student?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Remove</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if ($students->isNotEmpty())
                        <form action="{{ route('enrollments.store', $subject) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <select name="student_id" class="border rounded px-2 py-1" required>
                                <option value="" disabled selected>Select a student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Enroll</button>
                        </form>
                    @else
                        <p class="text-gray-500">All students are already enrolled.</p>
                    @endif
                </div>

                <a href="{{ route('subjects.index') }}" class="text-indigo-600 hover:underline">
                    ← Back to Subjects
                </a>

            </div>
        </div>
    </div>
</x-app-layout>