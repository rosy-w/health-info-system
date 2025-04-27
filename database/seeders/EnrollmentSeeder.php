<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\HealthProgram;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = User::role('doctor')->get();
        $programs = HealthProgram::all();

        foreach ($doctors as $doctor) {
            // Get clients assigned to this doctor
            $clients = $doctor->clients;

            foreach ($clients as $client) {
                // Enroll each client into 1 random program 
                $program = $programs->random();

                Enrollment::create([
                    'client_id' => $client->id,
                    'user_id' => $doctor->id,
                    'health_program_id' => $program->id,
                    'start_date' => now(),
                    //TODO: change this to period instead to reduce error and choose btn 3mnths,6months etc
                    'end_date' => now()->addMonths(6), // Example: 6 months enrollment
                ]);
            }
        }
    }
}
