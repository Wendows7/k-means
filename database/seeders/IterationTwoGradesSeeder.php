<?php

namespace Database\Seeders;

use App\Models\IterationTwoGrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IterationTwoGradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IterationTwoGrade::factory(50)->create();
    }
}
