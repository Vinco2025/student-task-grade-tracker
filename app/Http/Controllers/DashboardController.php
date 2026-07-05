<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use Psy\Command\WhereamiCommand;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'student') {
            return $this->studentDashboard($user);
        }
        if ($user->role === 'teacher') {
            return $this->teacherDashboard($user);
        }
        if ($user->role === 'admin') {
            return $this->adminDashboard($user);
        }
        abort(403);
    }

    private function studentDashboard($user)
    {
        $enrollments = $user->enrollments()
            ->with('subject.tasks')
            ->whereIn('status', ['approved', 'pending'])  
            ->get();

        $enrolledSubjectIds = $user->enrollments()->pluck('subject_id'); 

        $availableSubjects = Subject::with('teacher')
            ->whereNotIn('id', $enrolledSubjectIds)
            ->get();

        return view('dashboard.student', compact('enrollments', 'availableSubjects'));
    }

    private function teacherDashboard($user)
    {
        $subjects = $user->subjects()->with(['tasks', 'enrollments'])->get();

        return view('dashboard.teacher', compact('subjects'));
    }

    private function adminDashboard($user)
    {
        $totalStudents = User::Where('role', 'student')->count();
        $totalTeachers = User::Where('role', 'teacher')->count();
        $totalSubjects = Subject::count();

        $subjects = Subject::with(['teacher', 'tasks', 'enrollments'])->get();

        return view('dashboard.admin', compact(
            'totalStudents',
            'totalTeachers',
            'totalSubjects',
            'subjects'
        ));
    }
}
