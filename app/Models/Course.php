<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'thumbnail'];

    //create relation to course content
    public function contents()
    {
        return $this->hasMany(CourseContent::class);
    }

    //create relation to learning module
    public function modules()
    {
        return $this->hasMany(LearningModule::class);
    }
    public function getThumbnailAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
}
