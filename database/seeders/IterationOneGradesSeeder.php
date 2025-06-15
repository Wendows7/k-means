<?php

namespace Database\Seeders;

use App\Models\IterationOneGrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IterationOneGradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IterationOneGrade::factory(50)->create();
    }
}
