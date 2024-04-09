<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollments extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'student_id',
        'course_id',
        'class_id',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
