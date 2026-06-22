<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
