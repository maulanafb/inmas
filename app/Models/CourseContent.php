<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'video_url', 'course_id'];

    //create relation to course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
