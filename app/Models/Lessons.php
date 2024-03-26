<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'lesson_file',
        'lesson_link',
        'course_id',
    ];


    public function course()
    {
        return $this->belongsTo(Courses::class);
    }
}
