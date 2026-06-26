<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if ($enrollments->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-500">You are not enrolled in any subjects yet.</p>
                </div>
            @else
                @foreach ($enrollments as $enrollment)
                    @php $subject = $enrollment->subject; @endphp

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-3">{{ $subject->name }}</h3>

                        @if ($subject->tasks->isEmpty())
                            <p class="text-gray-500 text-sm">No tasks assigned yet.</p>
                        @else
                            <ul class="divide-y">
                                @foreach ($subject->tasks->sortBy('due_date') as $task)
                                    <li class="py-2 flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">{{ $task->title }}</p>
                                            <p class="text-sm text-gray-500">{{ $task->description }}</p>
                                        </div>
                                        <span class="text-sm text-gray-600">
                                            Due: {{ $task->due_date ?? 'No due date' }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</x-app-layout>