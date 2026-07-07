<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-ink leading-tight">
            {{ $subject->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            <div class="bg-paper border border-slate/20 rounded-lg p-6 space-y-8">

                {{-- Teacher --}}
                <p class="text-slate text-sm uppercase tracking-wide">
                    Teacher: <span class="text-ink font-semibold normal-case text-base">{{ $subject->teacher->name ?? 'Unassigned' }}</span>
                </p>

                {{-- Tasks --}}
                <div>
                    <div class="flex justify-between items-center mb-3 pb-2 border-b border-gold/40">
                        <h3 class="font-serif font-semibold text-lg text-ink">Tasks</h3>
                        @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'admin')
                            <a href="{{ route('subjects.tasks.create', $subject) }}"
                               class="text-sm text-gold hover:underline">+ Add Task</a>
                        @endif
                    </div>

                    @forelse ($subject->tasks as $task)
                        <div class="flex items-center justify-between py-2 border-b border-slate/10 last:border-0">
                            <div class="flex items-center gap-3">
                                <span class="w-0.5 h-5 bg-gold rounded-full inline-block"></span>
                                <a href="{{ route('tasks.show', $task) }}"
                                   class="text-ink font-medium hover:text-gold transition">
                                    {{ $task->title }}
                                </a>
                                <span class="text-slate text-sm">— Due: {{ $task->due_date ?? 'No due date' }}</span>
                            </div>
                            @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'admin')
                                <a href="{{ route('grades.edit', $task) }}"
                                   class="text-sm text-approved hover:underline">Grade</a>
                            @endif
                        </div>
                    @empty
                        <p class="text-slate text-sm">No tasks yet.</p>
                    @endforelse
                </div>

                {{-- Pending Requests (admin only) --}}
                @if(auth()->user()->role === 'admin' && $pendingEnrollments->isNotEmpty())
                    <div>
                        <div class="flex items-center mb-3 pb-2 border-b border-gold/40">
                            <h3 class="font-serif font-semibold text-lg text-ink">Pending Requests</h3>
                            <span class="ml-2 text-xs bg-gold/10 text-gold border border-gold/30 rounded-full px-2 py-0.5">
                                {{ $pendingEnrollments->count() }}
                            </span>
                        </div>
                        <ul class="divide-y divide-slate/10">
                            @foreach ($pendingEnrollments as $enrollment)
                                <li class="flex items-center justify-between py-3">
                                    <div class="flex items-center gap-3">
                                        <span class="w-0.5 h-5 bg-gold/40 rounded-full inline-block"></span>
                                        <span class="text-ink font-medium">{{ $enrollment->student->name }}</span>
                                        <span class="text-xs text-slate">requested enrollment</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <form action="{{ route('enrollments.approve', $enrollment) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="text-sm text-approved hover:underline">Approve</button>
                                        </form>
                                        <form action="{{ route('enrollments.reject', $enrollment) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="text-sm text-marked hover:underline">Reject</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Enrolled Students --}}
                <div>
                    <div class="flex justify-between items-center mb-3 pb-2 border-b border-gold/40">
                        <h3 class="font-serif font-semibold text-lg text-ink">Enrolled Students</h3>
                    </div>

                    @if($approvedEnrollments->isEmpty())
                        <p class="text-slate text-sm">No students enrolled yet.</p>
                    @else
                        <ul class="divide-y divide-slate/10">
                            @foreach ($approvedEnrollments as $enrollment)
                                <li class="flex items-center justify-between py-3">
                                    <div class="flex items-center gap-3">
                                        <span class="w-0.5 h-5 bg-gold rounded-full inline-block"></span>
                                        <span class="text-ink font-medium">{{ $enrollment->student->name }}</span>
                                    </div>
                                    @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST"
                                              onsubmit="return confirm('Remove this student?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-sm text-marked hover:underline">Remove</button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Admin: direct enroll --}}
                    @if(auth()->user()->role === 'admin' && $students->isNotEmpty())
                        <form action="{{ route('enrollments.store', $subject) }}" method="POST"
                              class="flex items-center gap-2 mt-4">
                            @csrf
                            <select name="student_id"
                                    class="border border-slate/30 rounded px-3 py-1.5 text-sm text-ink bg-paper focus:outline-none focus:border-gold">
                                <option value="" disabled selected>Select a student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit"
                                    class="bg-ink text-paper text-sm px-4 py-1.5 rounded hover:bg-gold transition-colors">
                                Enroll
                            </button>
                        </form>
                    @elseif(auth()->user()->role === 'admin')
                        <p class="text-slate text-sm mt-4">All students are already enrolled or have pending requests.</p>
                    @endif

                    {{-- Student: request enrollment --}}
                    @if(auth()->user()->role === 'student')
                        @php
                            $myEnrollment = $subject->enrollments->firstWhere('student_id', auth()->id());
                        @endphp

                        @if(!$myEnrollment)
                            <form action="{{ route('enrollments.request', $subject) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit"
                                        class="bg-ink text-paper text-sm px-4 py-1.5 rounded hover:bg-gold transition-colors">
                                    Request Enrollment
                                </button>
                            </form>
                        @elseif($myEnrollment->status === 'pending')
                            <p class="text-slate text-sm mt-4">⏳ Your enrollment request is pending approval.</p>
                        @elseif($myEnrollment->status === 'rejected')
                            <p class="text-marked text-sm mt-4">✕ Your enrollment request was rejected.</p>
                        @endif
                    @endif
                </div>

            </div>

            <a href="{{ route('dashboard') }}" class="text-sm text-slate hover:text-ink transition">
                ← Back to Dashboard
            </a>

        </div>
    </div>
</x-app-layout>