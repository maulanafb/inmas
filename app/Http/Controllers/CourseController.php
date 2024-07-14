<?php

namespace App\Http\Controllers;



use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('pages.admin.courses.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
        ]);

        $data = $request->only('title', 'description');
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Course::create($data);
        return response()->json(['success' => 'Course added successfully']);
    }
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $course_contents = CourseContent::where('course_id', $id)->get();
        $learning_modules = $course->modules;
        return view('pages.admin.courses.edit', compact('course', 'course_contents', 'learning_modules'));
    }
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        // Cari course berdasarkan ID
        $course = Course::findOrFail($id);

        // Hanya ambil data yang dibutuhkan
        $data = $request->only('title', 'description');

        // Jika ada file thumbnail baru
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }

            // Tentukan nama file dengan timestamp saja
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'thumbnails';

            // Simpan file menggunakan Storage::disk('public')->put()
            $filePath = $path . '/' . $fileName;
            $put = Storage::disk('public')->put($filePath, file_get_contents($file));

            if ($put) {
                $data['thumbnail'] = $filePath;
            } else {
                // Handle the error if the file was not stored successfully
                return back()->withErrors(['thumbnail' => 'Failed to upload thumbnail']);
            }
        }

        // Update data course
        $course->update($data);

        // Redirect ke route course.index dengan pesan sukses
        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }





    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        $course->delete();
        return response()->json(['success' => 'Course deleted successfully']);
    }
}
