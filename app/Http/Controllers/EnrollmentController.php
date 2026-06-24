<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Subject;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        $alreadyEnrolled = $subject->enrollments()
            ->where('student_id', $validated['student_id'])
            ->exists();

        if ($alreadyEnrolled) {
            return redirect()->route('subjects.show', $subject)->with('error', 'Student is already enrolled.');
        }

        $subject->enrollments()->create([
            'student_id' => $validated['student_id'],
        ]);

        return redirect()->route('subjects.show', $subject)->with('success', 'Student enrolled successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $subject = $enrollment->subject;
        $enrollment->delete();

        return redirect()->route('subjects.show', $subject)->with('success', 'Student removed from the subject.');
    }
}