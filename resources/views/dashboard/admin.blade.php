<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('subjects.index') }}" class="bg-white shadow-sm rounded-lg p-6 text-center hover:shadow-md transition">
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalStudents }}</p>
                    <p class="text-sm text-gray-500 mt-1">Students</p>
                </a>
                <a href="{{ route('subjects.index') }}" class="bg-white shadow-sm rounded-lg p-6 text-center hover:shadow-md transition">
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalTeachers }}</p>
                    <p class="text-sm text-gray-500 mt-1">Teachers</p>
                </a>
                <a href="{{ route('subjects.index') }}" class="bg-white shadow-sm rounded-lg p-6 text-center hover:shadow-md transition">
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalSubjects }}</p>
                    <p class="text-sm text-gray-500 mt-1">Subjects</p>
                </a>
            </div>

            {{-- Subjects Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">All Subjects</h3>
                    <a href="{{ route('subjects.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                        + New Subject
                    </a>
                </div>

                @if ($subjects->isEmpty())
                    <p class="text-gray-500">
                        No subjects created yet.
                        <a href="{{ route('subjects.create') }}" class="text-indigo-600 hover:underline">Create one</a>.
                    </p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 px-3">Subject</th>
                                <th class="py-2 px-3">Teacher</th>
                                <th class="py-2 px-3">Tasks</th>
                                <th class="py-2 px-3">Students Enrolled</th>
                                <th class="py-2 px-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $subject)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2 px-3">
                                        <a href="{{ route('subjects.show', $subject) }}" class="text-indigo-600 hover:underline">
                                            {{ $subject->name }}
                                        </a>
                                    </td>
                                    <td class="py-2 px-3">{{ $subject->teacher->name ?? 'Unassigned' }}</td>
                                    <td class="py-2 px-3">{{ $subject->tasks->count() }}</td>
                                    <td class="py-2 px-3">{{ $subject->enrollments->count() }}</td>
                                    <td class="py-2 px-3">
                                        <a href="{{ route('subjects.edit', $subject) }}" class="text-indigo-600 hover:underline text-sm mr-3">
                                            Edit
                                        </a>
                                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>