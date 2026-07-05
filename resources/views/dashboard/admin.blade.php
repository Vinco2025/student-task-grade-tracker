<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-ink leading-tight">
            {{ __('Admin Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('users.students') }}" class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:border-gold hover:shadow-sm transition">
                    <p class="text-4xl font-bold text-gold" style="font-family: 'Fraunces', serif;">{{ $totalStudents }}</p>
                    <p class="text-sm text-slate mt-1 uppercase tracking-wide">Students</p>
                </a>
                <a href="{{ route('users.teachers') }}" class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:border-gold hover:shadow-sm transition">
                    <p class="text-4xl font-bold text-gold" style="font-family: 'Fraunces', serif;">{{ $totalTeachers }}</p>
                    <p class="text-sm text-slate mt-1 uppercase tracking-wide">Teachers</p>
                </a>
                <a href="{{ route('subjects.index') }}" class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:border-gold hover:shadow-sm transition">
                    <p class="text-4xl font-bold text-gold" style="font-family: 'Fraunces', serif;">{{ $totalSubjects }}</p>
                    <p class="text-sm text-slate mt-1 uppercase tracking-wide">Subjects</p>
                </a>
            </div>

            {{-- Subjects Table --}}
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-ink" style="font-family: 'Fraunces', serif;">All Subjects</h3>
                    <a href="{{ route('subjects.create') }}" class="px-4 py-2 bg-ink text-white rounded hover:bg-[#2A3B5F] text-sm transition">
                        + New Subject
                    </a>
                </div>

                @if ($subjects->isEmpty())
                    <p class="text-slate">
                        No subjects created yet.
                        <a href="{{ route('subjects.create') }}" class="text-gold hover:underline">Create one</a>.
                    </p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-ink">
                                <th class="py-2 px-3 text-xs uppercase tracking-wide text-slate">Subject</th>
                                <th class="py-2 px-3 text-xs uppercase tracking-wide text-slate">Teacher</th>
                                <th class="py-2 px-3 text-xs uppercase tracking-wide text-slate">Tasks</th>
                                <th class="py-2 px-3 text-xs uppercase tracking-wide text-slate">Students Enrolled</th>
                                <th class="py-2 px-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $subject)
                                <tr class="border-b border-gray-100 odd:bg-[#FAFAF8] hover:bg-[#F7F1E3] transition">
                                    <td class="py-2 px-3">
                                        <a href="{{ route('subjects.show', $subject) }}" class="text-ink font-medium hover:text-gold hover:underline">
                                            {{ $subject->name }}
                                        </a>
                                    </td>
                                    <td class="py-2 px-3 text-slate">{{ $subject->teacher->name ?? 'Unassigned' }}</td>
                                    <td class="py-2 px-3 text-slate">{{ $subject->tasks->count() }}</td>
                                    <td class="py-2 px-3 text-slate">{{ $subject->enrollments->where('status','approved')->count() }}</td>
                                    <td class="py-2 px-3">
                                        <a href="{{ route('subjects.edit', $subject) }}" class="text-ink hover:text-gold hover:underline text-sm mr-3">
                                            Edit
                                        </a>
                                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 hover:underline text-sm font-medium">Delete</button>
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