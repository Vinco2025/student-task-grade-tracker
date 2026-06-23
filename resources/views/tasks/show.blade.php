<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $task->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <p class="mb-2 text-gray-600">
                    Subject: <strong>{{ $task->subject->name }}</strong>
                </p>

                <p class="mb-4 text-gray-600">
                    Due: {{ $task->due_date ?? 'No due date' }}
                </p>

                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-1">Description</h3>
                    <p class="text-gray-700">{{ $task->description ?? 'No description provided.' }}</p>
                </div>

                <h3 class="text-lg font-medium mb-2">Grades</h3>
                <ul class="mb-6 list-disc list-inside">
                    @forelse ($task->grades as $grade)
                        <li>{{ $grade->student->name }} — {{ $grade->score ?? 'Not graded' }}</li>
                    @empty
                        <li class="text-gray-500">No grades submitted yet.</li>
                    @endforelse
                </ul>

                <div class="flex justify-between items-center">
                    <a href="{{ route('subjects.show', $task->subject) }}" class="text-indigo-600 hover:underline">
                        ← Back to {{ $task->subject->name }}
                    </a>

                    <div class="flex gap-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>