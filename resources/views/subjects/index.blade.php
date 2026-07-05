<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Subjects
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <x-flash-messages />

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">All Subjects</h3>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('subjects.create') }}" class="px-4 py-2 bg-[#1E2A45] text-white rounded hover:bg-[#1E2A45]">
                            + New Subject
                        </a>
                    @endif
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Name</th>
                            <th class="py-2">Teacher</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subjects as $subject)
                            <tr class="border-b">
                                <td class="py-2">
                                    <a href="{{ route('subjects.show', $subject) }}" class="text-[#1E2A45] hover:text-[#C08A2E] hover:underline">
                                        {{ $subject->name }}
                                    </a>
                                </td>
                                <td class="py-2 text-[#5B6472]">{{ $subject->teacher->name ?? 'Unassigned' }}</td>
                                <td class="py-2">
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('subjects.edit', $subject) }}" class="text-[#1E2A45] hover:text-[#C08A2E] hover:underline">Edit</a>
                                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-4 text-gray-500">
                                    No subjects yet. <a href="{{ route('subjects.create') }}" class="text-indigo-600 hover:underline">Create one</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>