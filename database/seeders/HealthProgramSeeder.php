<?php

namespace Database\Seeders;

use App\Models\HealthProgram;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HealthProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         HealthProgram::create([
            'name' => 'Tuberculosis (TB) Program',
            'description' => 'Comprehensive TB prevention and treatment services.',
        ]);

        HealthProgram::create([
            'name' => 'HIV/AIDS Care Program',
            'description' => 'HIV/AIDS education, testing, and care services.',
        ]);
    }
}
