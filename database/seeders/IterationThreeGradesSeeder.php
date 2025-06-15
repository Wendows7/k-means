<?php

namespace Database\Seeders;

use App\Models\IterationThreeGrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IterationThreeGradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IterationThreeGrade::factory(50)->create();
    }
}
