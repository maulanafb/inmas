<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\LearningModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LearningModuleController extends Controller
{
    public function store(Request $request, $course_id)
    {
        // Validate data received
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'guide_url' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Validate file type and size
        ]);

        // Check if guide_url file is present in the request
        if ($request->hasFile('guide_url')) {
            // Store the file using Storage::disk('public')
            $file = $request->file('guide_url');
            $filePath = 'guides/' . $file->getClientOriginalName();
            Storage::disk('public')->put($filePath, file_get_contents($file));
            $data['guide_url'] = $filePath;
        }

        // Set the course_id in the data array
        $data['course_id'] = $course_id;

        // Create a new learning module associated with the course
        LearningModule::create($data);

        // Redirect to the course edit page with a success message
        return redirect()->route('courses.edit', $course_id)->with('success', 'Learning Module created successfully.');
    }

    public function update(Request $request, $learningModule_id)
    {
        // Find the LearningModule by its ID
        $learningModule = LearningModule::findOrFail($learningModule_id);

        // Validate data received
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'guide_url' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Validate file type and size
        ]);

        // Check if a new guide_url file is uploaded
        if ($request->hasFile('guide_url')) {
            // Delete the old guide_url file if it exists
            if ($learningModule->guide_url) {
                Storage::disk('public')->delete($learningModule->guide_url);
            }

            // Store the new file using Storage::disk('public')
            $file = $request->file('guide_url');
            $filePath = 'guides/' . $file->getClientOriginalName();
            Storage::disk('public')->put($filePath, file_get_contents($file));
            $data['guide_url'] = $filePath;
        }

        // Update the learning module with validated data
        $learningModule->update($data);

        // Redirect to the course edit page with a success message
        return redirect()->route('courses.edit', $learningModule->course_id)->with('success', 'Learning Module updated successfully.');
    }

    public function destroy($learningModule_id)
    {
        // Find the LearningModule by its ID
        $learningModule = LearningModule::findOrFail($learningModule_id);

        // Delete the guide_url file from storage if it exists
        if ($learningModule->guide_url) {
            Storage::disk('public')->delete($learningModule->guide_url);
        }

        // Delete the learning module from the database
        $learningModule->delete();

        // Redirect to the course edit page with a success message
        return redirect()->route('courses.edit', $learningModule->course_id)->with('success', 'Learning Module deleted successfully.');
    }
}
