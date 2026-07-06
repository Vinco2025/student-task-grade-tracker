<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Subject;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function request(Subject $subject)
    {
        $user = auth()->user();

        $already = $subject->enrollments()
            ->where('student_id', $user->id)
            ->whereIn('status', ['approved', 'pending'])
            ->exists();

        if ($already) {
            return redirect()->route('dashboard')
                ->with('error', 'You already have a pending or active enrollment for this subject.');
        }

        $subject->enrollments()->updateOrCreate(
            ['student_id' => $user->id],
            ['status' => 'pending']
        );

        return redirect()->route('dashboard')
            ->with('success', 'Enrollment request sent. Please wait for admin approval.');
    }

    public function store(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        $already = $subject->enrollments()
            ->where('student_id', $validated['student_id'])
            ->whereIn('status', ['approved', 'pending'])
            ->exists();

        if ($already) {
            return redirect()->route('subjects.show', $subject)
                ->with('error', 'Student is already enrolled.');
        }

        $subject->enrollments()->create([
            'student_id' => $validated['student_id'],
            'status'     => 'approved',
        ]);

        return redirect()->route('subjects.show', $subject)
            ->with('success', 'Student enrolled successfully.');
    }

    public function approve(Enrollment $enrollment)
    {
        $enrollment->update(['status' => 'approved']);

        return redirect()->route('subjects.show', $enrollment->subject)
            ->with('success', 'Enrollment approved.');
    }

    public function reject(Enrollment $enrollment)
    {
        $enrollment->update(['status' => 'rejected']);

        return redirect()->route('subjects.show', $enrollment->subject)
            ->with('success', 'Enrollment rejected.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $subject = $enrollment->subject;
        $enrollment->delete();

        return redirect()->route('subjects.show', $subject)
            ->with('success', 'Student removed from the subject.');
    }
}