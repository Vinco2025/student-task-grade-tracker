<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function edit(Task $task)
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }

        $submission = Submission::where('task_id', $task->id)
            ->where('student_id', auth()->id())
            ->first();

        $isPastDue = $task->due_date && now()->startOfDay()->gt($task->due_date);

        return view('submissions.edit', compact('task', 'submission', 'isPastDue'));
    }

    public function update(Request $request, Task $task)
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }

        if ($task->due_date && now()->startOfDay()->gt($task->due_date)) {
            return redirect()->route('tasks.submissions.edit', $task)
                ->with('error', 'The deadline for this task has passed. You can no longer submit.');
        }

        $validated = $request->validate([
            'content' => 'required_without:file',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,zip|max:10240',
        ]);

        $data = [
            'task_id' => $task->id,
            'student_id' => auth()->id(),
            'content' => $validated['content'] ?? null,
            'submitted_at' => now(),
        ];

        if ($request->hasFile('file')) {
            $existing = Submission::where('task_id', $task->id)
                ->where('student_id', auth()->id())
                ->first();

            if ($existing && $existing->file_path) {
                Storage::disk('public')->delete($existing->file_path);
            }

            $path = $request->file('file')->store('submissions', 'public');
            $data['file_path'] = $path;
            $data['original_filename'] = $request->file('file')->getClientOriginalName();
        }

        Submission::updateOrCreate(
            ['task_id' => $task->id, 'student_id' => auth()->id()],
            $data
        );

        return redirect()->route('tasks.submissions.edit', $task)
            ->with('success', 'Your work has been submitted.');
    }
}
