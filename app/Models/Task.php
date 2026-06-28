<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected  $fillable = ['title', 'description', 'due_date', 'subject_id'];

    protected $casts = [
        'due_date' => 'date',
    ];
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
