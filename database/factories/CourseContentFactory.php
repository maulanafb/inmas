<?php

namespace Database\Factories;

use App\Models\CourseContent;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseContentFactory extends Factory
{
    protected $model = CourseContent::class;

    public function definition()
    {
        return [
            'course_id' => Course::first()->id,
            'title' => $this->faker->sentence,
            'video_url' => $this->faker->url,
            'description' => $this->faker->paragraph,
        ];
    }
}
