<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'teacher_id'];
    
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
