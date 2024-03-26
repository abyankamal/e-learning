<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lessons::class);
    }

    public function enrolledStudents()  // Assuming using Enrollments table
    {
        return $this->hasMany(User::class, 'course_id', 'id')
            ->through(Enrollments::class);
    }
}
