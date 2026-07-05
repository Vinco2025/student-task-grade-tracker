<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-ink leading-tight">
            My Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            {{-- Enrolled Subjects --}}
            <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-6">
                <div class="pb-2 border-b border-gold/40">
                    <h3 class="font-serif font-semibold text-lg text-ink">My Subjects</h3>
                </div>

                @if ($enrollments->isEmpty())
                    <p class="text-slate text-sm">You are not enrolled in any subjects yet.</p>
                @else
                    @foreach ($enrollments as $enrollment)
                        @php $subject = $enrollment->subject; @endphp

                        <div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="w-0.5 h-6 bg-gold rounded-full inline-block"></span>
                                <h4 class="font-serif font-semibold text-ink text-base">{{ $subject->name }}</h4>

                                {{-- Enrollment status badge --}}
                                @if($enrollment->status === 'pending')
                                    <span class="text-xs bg-gold/10 text-gold border border-gold/30 rounded-full px-2 py-0.5">⏳ Pending</span>
                                @elseif($enrollment->status === 'rejected')
                                    <span class="text-xs bg-marked/10 text-marked border border-marked/30 rounded-full px-2 py-0.5">✕ Rejected</span>
                                @endif
                            </div>

                            @if($enrollment->status !== 'approved')
                                <p class="text-slate text-sm ml-4">
                                    @if($enrollment->status === 'pending')
                                        Your enrollment request is awaiting admin approval.
                                    @else
                                        Your enrollment request was rejected. Contact your admin.
                                    @endif
                                </p>
                            @elseif ($subject->tasks->isEmpty())
                                <p class="text-slate text-sm ml-4">No tasks assigned yet.</p>
                            @else
                                <ul class="divide-y divide-gray-100 ml-4">
                                    @foreach ($subject->tasks->sortBy('due_date') as $task)
                                        @php $overdue = $task->due_date && now()->startOfDay()->gt($task->due_date); @endphp
                                        <li class="py-2 flex justify-between items-center">
                                            <div>
                                                <a href="{{ route('tasks.submissions.edit', $task) }}"
                                                   class="font-medium text-ink hover:text-gold transition">
                                                    {{ $task->title }}
                                                </a>
                                                @if($task->description)
                                                    <p class="text-sm text-slate">{{ $task->description }}</p>
                                                @endif
                                            </div>
                                            <span class="text-sm {{ $overdue ? 'text-marked font-medium' : 'text-slate' }}">
                                                Due: {{ $task->due_date?->format('M d, Y') ?? 'No due date' }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        @if(!$loop->last)
                            <hr class="border-gray-100">
                        @endif
                    @endforeach
                @endif
            </div>

            {{-- Available Subjects --}}
            @if($availableSubjects->isNotEmpty())
                <div class="bg-white border border-gray-200 rounded-lg p-6 space-y-4">
                    <div class="pb-2 border-b border-gold/40">
                        <h3 class="font-serif font-semibold text-lg text-ink">Available Subjects</h3>
                        <p class="text-slate text-sm mt-1">Request enrollment in a subject below.</p>
                    </div>

                    @foreach($availableSubjects as $subject)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                            <div class="flex items-center gap-3">
                                <span class="w-0.5 h-5 bg-gold/40 rounded-full inline-block"></span>
                                <div>
                                    <p class="text-ink font-medium">{{ $subject->name }}</p>
                                    <p class="text-slate text-xs">{{ $subject->teacher->name ?? 'Unassigned' }}</p>
                                </div>
                            </div>
                            <form action="{{ route('enrollments.request', $subject) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="text-sm bg-ink text-white px-3 py-1.5 rounded hover:bg-ink/80 transition">
                                    Request Enrollment
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>