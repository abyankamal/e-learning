<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_file',
        'submission_date',
        'grade',
        'feedback',
        'task_id',
        'student_id'
    ];
}
