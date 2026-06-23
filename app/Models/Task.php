<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected  $fillable = ['title', 'description', 'due_date', 'subject_id'];
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
