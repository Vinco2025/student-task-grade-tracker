<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1E2A45] leading-tight" style="font-family: 'Fraunces', serif;">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            <div class="flex justify-between items-center">
                <p class="text-sm text-[#5B6472]">{{ $students->count() }} student{{ $students->count() !== 1 ? 's' : '' }} registered</p>
                <a href="{{ route('dashboard') }}" class="text-[#1E2A45] hover:text-[#C08A2E] text-sm hover:underline">
                    ← Back to Dashboard
                </a>
            </div>

            @if ($students->isEmpty())
                <div class="bg-white border border-gray-200 rounded-lg p-10 text-center">
                    <p class="text-[#5B6472]">No students registered yet.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($students as $student)
                        <div class="bg-white border border-gray-200 rounded-lg p-5 flex items-start gap-4 hover:border-[#C08A2E] transition">

                            {{-- Avatar initial --}}
                            <div class="shrink-0 w-11 h-11 rounded-full bg-[#1E2A45] text-white flex items-center justify-center font-semibold" style="font-family: 'Fraunces', serif;">
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-baseline justify-between gap-2 flex-wrap">
                                    <h3 class="text-[#1E2A45] font-semibold">{{ $student->name }}</h3>
                                    <span class="text-sm text-[#5B6472]">{{ $student->email }}</span>
                                </div>

                                <div class="mt-3">
                                    @forelse ($student->enrollments as $enrollment)
                                        <div class="flex items-center gap-2 py-1.5 pl-3 border-l-2 border-[#C08A2E] {{ !$loop->last ? 'mb-1' : '' }}">
                                            <span class="text-sm text-[#1E2A45]">{{ $enrollment->subject->name ?? 'Unknown' }}</span>
                                        </div>
                                    @empty
                                        <p class="text-gray-400 italic text-sm">Not enrolled in any subject</p>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>