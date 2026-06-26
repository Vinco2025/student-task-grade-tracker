<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $enrollments = $user->enrollments()->with('subject.tasks')->get();

        return view('dashboard.student', compact('enrollments'));
    }

    private function teacherDashboard($user)
    {
        $subjects = $user->subjects()->with('tasks')->get();

        return view('dashboard.teacher', compact('subjects'));
    }

    private function adminDashboard($user)
    {
        return view('dashboard.admin');
    }
}
