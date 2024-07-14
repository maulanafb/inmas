<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LearningModule;

class LearningModuleSeeder extends Seeder
{
    public function run()
    {
        LearningModule::factory()->count(2)->create();
    }
}
