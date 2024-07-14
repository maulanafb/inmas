<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;

class CourseContentController extends Controller
{
    public function store(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $course->contents()->create($request->all());
        return redirect()->route('courses.edit', $courseId)->with('success', 'Content added successfully.');
    }

    public function update(Request $request, $courseId, $id)
    {
        $content = CourseContent::where('course_id', $courseId)->findOrFail($id);
        $content->update($request->all());
        return redirect()->route('courses.edit', $courseId)->with('success', 'Content updated successfully.');
    }

    public function destroy($courseId, $id)
    {
        $content = CourseContent::where('course_id', $courseId)->findOrFail($id);
        $content->delete();
        return redirect()->route('courses.edit', $courseId)->with('success', 'Content deleted successfully.');
    }
}
