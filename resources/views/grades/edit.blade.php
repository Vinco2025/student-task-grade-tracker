<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Grades for: {{ $task->title }}
        </h2>
        <p class="text-sm text-gray-500">{{ $task->subject->name }}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

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
                                    <th class="py-2 px-3">Student Name</th>
                                    <th class="py-2 px-3">Email</th>
                                    <th class="py-2 px-3 w-32">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr class="border-b">
                                        <td class="py-2 px-3">{{ $student->name }}</td>
                                        <td class="py-2 px-3 text-gray-500">{{ $student->email }}</td>
                                        <td class="py-2 px-3">
                                            <input
                                                type="number"
                                                step="any"
                                                min="0"
                                                max="100"
                                                inputmode="decimal"
                                                name="scores[{{ $student->id }}]"
                                                value="{{ old('scores.' . $student->id, $existingGrades[$student->id]->score ?? '') }}"
                                                class="w-24 rounded border-gray-300 shadow-sm"
                                                placeholder="—"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6 flex items-center gap-6">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                Save Grades
                            </button>
                            <a href="{{ route('subjects.show', $task->subject_id) }}" class="ml-3 text-gray-600 hover:underline">
                                Cancel
                            </a>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>