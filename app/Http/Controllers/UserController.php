<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function students()
    {
        $students = User::where('role', 'student')
            ->with('enrollments.subject')
            ->get();

        return view('users.students', compact('students'));
    }

    public function teachers()
    {
        $teachers = User::where('role', 'teacher')
            ->with('subjects')
            ->get();

        return view('users.teachers', compact('teachers'));
    }
}