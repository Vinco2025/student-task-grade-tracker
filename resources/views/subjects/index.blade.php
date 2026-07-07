<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink leading-tight font-serif">
            Subjects
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-paper overflow-hidden shadow-sm sm:rounded-lg p-6">

                <x-flash-messages />

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-ink font-serif">All Subjects</h3>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('subjects.create') }}"
                           class="px-4 py-2 bg-ink text-paper text-sm font-medium rounded hover:bg-gold transition-colors">
                            + New Subject
                        </a>
                    @endif
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate/20">
                            <th class="py-2 text-xs font-semibold uppercase tracking-wide text-slate">Name</th>
                            <th class="py-2 text-xs font-semibold uppercase tracking-wide text-slate">Teacher</th>
                            <th class="py-2 text-xs font-semibold uppercase tracking-wide text-slate">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subjects as $subject)
                            <tr class="border-b border-slate/10 hover:bg-gold/5 transition-colors">
                                <td class="py-3">
                                    <a href="{{ route('subjects.show', $subject) }}"
                                       class="text-ink font-medium hover:text-gold hover:underline transition-colors">
                                        {{ $subject->name }}
                                    </a>
                                </td>
                                <td class="py-3 text-slate text-sm">{{ $subject->teacher->name ?? 'Unassigned' }}</td>
                                <td class="py-3 flex items-center gap-3">
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('subjects.edit', $subject) }}"
                                           class="text-sm text-ink hover:text-gold hover:underline transition-colors">Edit</a>
                                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this subject?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-sm text-marked hover:underline transition-colors">Delete</button>
                                        </form>
                                    @else
                                        <span class="text-slate/40">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-8 text-center text-slate text-sm">
                                    No subjects yet.
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('subjects.create') }}"
                                           class="text-ink hover:text-gold hover:underline ml-1">Create one</a>.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>