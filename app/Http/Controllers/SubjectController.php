<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('teacher')->get();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('subjects.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => ['required', Rule::exists('users', 'id')->where('role', 'teacher')],
        ], [
            'teacher_id.required' => 'Please pick a teacher.',
        ]);

        Subject::create($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        $subject->load(['teacher', 'tasks', 'enrollments.student']);

        $enrolledIds = $subject->enrollments
            ->whereIn('status', ['approved', 'pending'])
            ->pluck('student_id');

        $students = \App\Models\User::where('role', 'student')
            ->whereNotIn('id', $enrolledIds)
            ->get();

        $pendingEnrollments = $subject->enrollments->where('status', 'pending');

        $approvedEnrollments = $subject->enrollments->where('status', 'approved');

        return view('subjects.show', compact(
            'subject',
            'students',
            'pendingEnrollments',
            'approvedEnrollments'
        ));
    }

    public function edit(Subject $subject)
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('subjects.edit', compact('subject', 'teachers'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => ['required', Rule::exists('users', 'id')->where('role', 'teacher')],
        ], [
            'teacher_id.required' => 'Please pick a teacher.',
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}