<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningModule extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'guide_url'];

    //create relation to course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
