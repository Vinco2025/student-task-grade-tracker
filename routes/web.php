<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/subjects/{subject}/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('/enrollments/{enrollment}/', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
});

Route::get('/admin/test', function () {
    return 'Welcome, Admin! This pade is protected.';
})->middleware(['auth', 'role:admin']);

Route::middleware(['auth'])->group(function () {
    Route::resource('subjects', SubjectController::class);
    Route::resource('subjects.tasks', TaskController::class)->shallow();
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/tasks/{task)/grades', [GradeController::class, 'edit'])->name('grades.edit');
    Route::post('/tasks/{task)/grades', [GradeController::class, 'update'])->name('grades.update');
});

require __DIR__.'/auth.php';
