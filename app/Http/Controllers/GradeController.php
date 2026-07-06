<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Grade;
use App\Models\Submission;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function edit(Task $task)
    {
        // this section will authorize only the teacher who owns this task's subject can grade it
        if ($task->subject->teacher_id !== auth()->id()) {
            abort(403);
        }

        // get att students enrolled in this task's subject
        $students = $task->subject->enrollments()->with('student')->get()->pluck('student');
        $existingGrades = $task->grades()->get()->keyBy('student_id');
        $submissions = Submission::where('task_id', $task->id)
            ->get()
            ->keyBy('student_id');

        return view('grades.edit', compact('task', 'students', 'existingGrades', 'submissions'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->subject->teacher_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'nullable|numeric|min:0|max:100',
            'feedback' => 'nullable|array',
            'feedback.*' => 'nullable|string|max:1000',
        ]);

        foreach ($validated['scores'] as $studentId => $score) {
            if ($score === null) continue; 

            Grade::updateOrCreate(
                ['task_id' => $task->id, 'student_id' => $studentId],
                [
                    'score' => $score,
                    'feedback' => $validated['feedback'][$studentId] ?? null,
                ]
            );
        }

        return redirect()->route('subjects.show', $task->subject_id)
            ->with('success', 'Grades saved successfully.');
    }
}