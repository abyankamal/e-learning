<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'description',
        'course_id,'
    ];

    public function course()
    {
        return $this->belongsToMany(Courses::class, 'id');
    }
}
