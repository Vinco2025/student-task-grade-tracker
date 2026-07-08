<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Subject;
use App\Models\Enrollment;
use App\Models\Task;
use App\Models\Grade;
use App\Models\Submission;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Users ──────────────────────────────────────────────
        $admin = User::create([
            'name'              => 'Admin User',
            'email'             => 'admin@demo.com',
            'password'          => Hash::make('password'),
            'role'              => 'admin',
            'email_verified_at' => now(),
        ]);

        $teacher1 = User::create([
            'name'              => 'Ms. Reyes',
            'email'             => 'reyes@demo.com',
            'password'          => Hash::make('password'),
            'role'              => 'teacher',
            'email_verified_at' => now(),
        ]);

        $teacher2 = User::create([
            'name'              => 'Mr. Santos',
            'email'             => 'santos@demo.com',
            'password'          => Hash::make('password'),
            'role'              => 'teacher',
            'email_verified_at' => now(),
        ]);

        $student1 = User::create([
            'name'              => 'Ana Cruz',
            'email'             => 'ana@demo.com',
            'password'          => Hash::make('password'),
            'role'              => 'student',
            'email_verified_at' => now(),
        ]);

        $student2 = User::create([
            'name'              => 'Ben Lim',
            'email'             => 'ben@demo.com',
            'password'          => Hash::make('password'),
            'role'              => 'student',
            'email_verified_at' => now(),
        ]);

        $student3 = User::create([
            'name'              => 'Cara Tan',
            'email'             => 'cara@demo.com',
            'password'          => Hash::make('password'),
            'role'              => 'student',
            'email_verified_at' => now(),
        ]);

        // ── Subjects ───────────────────────────────────────────
        $math = Subject::create([
            'name'       => 'Mathematics',
            'teacher_id' => $teacher1->id,
        ]);

        $english = Subject::create([
            'name'       => 'English',
            'teacher_id' => $teacher1->id,
        ]);

        $science = Subject::create([
            'name'       => 'Science',
            'teacher_id' => $teacher2->id,
        ]);

        // ── Enrollments ────────────────────────────────────────
        // Ana: enrolled in all three
        Enrollment::create(['subject_id' => $math->id,    'student_id' => $student1->id, 'status' => 'approved']);
        Enrollment::create(['subject_id' => $english->id, 'student_id' => $student1->id, 'status' => 'approved']);
        Enrollment::create(['subject_id' => $science->id, 'student_id' => $student1->id, 'status' => 'approved']);

        // Ben: enrolled in two, pending on one
        Enrollment::create(['subject_id' => $math->id,    'student_id' => $student2->id, 'status' => 'approved']);
        Enrollment::create(['subject_id' => $science->id, 'student_id' => $student2->id, 'status' => 'approved']);
        Enrollment::create(['subject_id' => $english->id, 'student_id' => $student2->id, 'status' => 'pending']);

        // Cara: one approved, one rejected, one not requested
        Enrollment::create(['subject_id' => $english->id, 'student_id' => $student3->id, 'status' => 'approved']);
        Enrollment::create(['subject_id' => $math->id,    'student_id' => $student3->id, 'status' => 'rejected']);

        // ── Tasks ──────────────────────────────────────────────
        $task1 = Task::create([
            'subject_id'  => $math->id,
            'title'       => 'Algebra Problem Set',
            'description' => 'Solve exercises 1–20 from Chapter 3. Show all working.',
            'due_date'    => Carbon::now()->addDays(7),
        ]);

        $task2 = Task::create([
            'subject_id'  => $math->id,
            'title'       => 'Geometry Quiz',
            'description' => 'Answer all questions on angles, triangles, and circles.',
            'due_date'    => Carbon::now()->subDays(3), // past due
        ]);

        $task3 = Task::create([
            'subject_id'  => $english->id,
            'title'       => 'Essay: My Hero',
            'description' => 'Write a 300-word essay about someone you admire.',
            'due_date'    => Carbon::now()->addDays(5),
        ]);

        $task4 = Task::create([
            'subject_id'  => $english->id,
            'title'       => 'Reading Comprehension',
            'description' => 'Read the passage and answer the questions that follow.',
            'due_date'    => Carbon::now()->subDays(1), // past due
        ]);

        $task5 = Task::create([
            'subject_id'  => $science->id,
            'title'       => 'Lab Report: Photosynthesis',
            'description' => 'Write up your observations from the leaf experiment.',
            'due_date'    => Carbon::now()->addDays(10),
        ]);

        // ── Submissions ────────────────────────────────────────
        // Ana submitted task1 and task2 (math) and task3 (english)
        $sub1 = Submission::create([
            'task_id'      => $task1->id,
            'student_id'   => $student1->id,
            'content'      => 'Here are my solutions for exercises 1–20. I used substitution for problems 5, 9, and 14.',
            'submitted_at' => Carbon::now()->subHours(2),
        ]);

        $sub2 = Submission::create([
            'task_id'      => $task2->id,
            'student_id'   => $student1->id,
            'content'      => 'Completed all geometry questions. Used the angle-sum property for triangles throughout.',
            'submitted_at' => Carbon::now()->subDays(2),
        ]);

        $sub3 = Submission::create([
            'task_id'      => $task3->id,
            'student_id'   => $student1->id,
            'content'      => 'My hero is my mother. She works two jobs and still finds time to help me with my studies every night.',
            'submitted_at' => Carbon::now()->subHours(5),
        ]);

        // Ben submitted task1 and task5 (science)
        $sub4 = Submission::create([
            'task_id'      => $task1->id,
            'student_id'   => $student2->id,
            'content'      => 'I completed exercises 1–20. Some of the later ones were tricky but I worked through them.',
            'submitted_at' => Carbon::now()->subHours(4),
        ]);

        $sub5 = Submission::create([
            'task_id'      => $task5->id,
            'student_id'   => $student2->id,
            'content'      => 'Lab report attached. The leaf in sunlight produced noticeably more oxygen bubbles than the shaded one.',
            'submitted_at' => Carbon::now()->subHours(1),
        ]);

        // Cara submitted task3 (english)
        $sub6 = Submission::create([
            'task_id'      => $task3->id,
            'student_id'   => $student3->id,
            'content'      => 'My hero is Lola. She raised seven children on her own and never complained once.',
            'submitted_at' => Carbon::now()->subHours(3),
        ]);

        // ── Grades ─────────────────────────────────────────────
        // task2 is past due — grade Ana's submission
        Grade::create([
            'task_id'    => $task2->id,
            'student_id' => $student1->id,
            'score'      => 88,
            'feedback'   => 'Great work on the triangle section. Review your circle theorems for next time.',
        ]);

        // task4 is past due — grade Cara's task3 submission (english)
        Grade::create([
            'task_id'    => $task3->id,
            'student_id' => $student3->id,
            'score'      => 75,
            'feedback'   => 'Good story. Work on paragraph structure and vary your sentence lengths.',
        ]);

        // Ana's essay also graded
        Grade::create([
            'task_id'    => $task3->id,
            'student_id' => $student1->id,
            'score'      => 92,
            'feedback'   => 'Excellent writing. Very heartfelt and well-structured.',
        ]);
    }
}