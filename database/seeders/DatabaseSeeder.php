<?php

namespace Database\Seeders;

use App\Models\IterationOneGrade;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(IterationOneGradesSeeder::class);
        $this->call(ClustersSeeder::class);
        $this->call(IterationTwoGradesSeeder::class);
        $this->call(IterationThreeGradesSeeder::class);

//        create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@laravel.com',
            'password' => bcrypt('admin123')
            ]);
    }
}
