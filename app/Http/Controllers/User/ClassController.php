<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseContent;
use App\Models\LearningModule;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index($contentId)
    {
        $content = CourseContent::findOrFail($contentId);
        $course = Course::findOrFail($content->course_id);
        $contents = CourseContent::where('course_id', $course->id)->get();
        $modules = LearningModule::where('course_id', $course->id)->get();
        return view('pages.user.class.class', compact('content', 'course', 'contents', 'modules'));
    }
}
