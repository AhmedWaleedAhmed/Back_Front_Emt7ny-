<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class exam extends Model
{
    protected $guarded = ['id'];
    
    protected $appends = ['full_mark'];
    
    public function questions()
    {
        return $this->hasMany(question::class, 'examId');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'exams_teachers', 'examId', 'teacherId')
            ->withTimestamps();
    }
    
    public function students()
    {
        return $this->belongsToMany(User::class, 'students_exams', 'examId', 'studentId');
    }

    public function getFullMarkAttribute()
    {
        return $this->questions()->sum('fullmark');
    }
}
