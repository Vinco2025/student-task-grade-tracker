<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalStudents }}</p>
                    <p class="text-sm text-gray-500 mt-1">Students</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalTeachers }}</p>
                    <p class="text-sm text-gray-500 mt-1">Teachers</p>
                </div>
                <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalSubjects }}</p>
                    <p class="text-sm text-gray-500 mt-1">Subjects</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">All Subjects</h3>

                @if ($subjects->isEmpty())
                    <p class="text-gray-500">No subjects created yet.</p>
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
                                <tr class="border-b">
                                    <td class="py-2 px-3">{{ $subject->name }}</td>
                                    <td class="py-2 px-3">{{ $subject->teacher->name ?? 'Unassigned' }}</td>
                                    <td class="py-2 px-3">{{ $subject->tasks->count() }}</td>
                                    <td class="py-2 px-3">{{ $subject->enrollments->count() }}</td>
                                    <td class="py-2 px-3">
                                        <a href="{{ route('subjects.show', $subject) }}" class="text-indigo-600 hover:underline text-sm">
                                            View
                                        </a>
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