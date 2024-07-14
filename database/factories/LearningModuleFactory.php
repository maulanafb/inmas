<?php

namespace Database\Factories;

use App\Models\LearningModule;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class LearningModuleFactory extends Factory
{
    protected $model = LearningModule::class;

    public function definition()
    {
        return [
            'course_id' => Course::first()->id,
            'title' => $this->faker->sentence,
            'guide_url' => $this->faker->url,
        ];
    }
}
