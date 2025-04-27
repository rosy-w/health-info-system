<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all doctors 
        $doctors = User::role('doctor')->get();
        $clients = Client::all();

        foreach ($doctors as $doctor) {
            // Assign a random client to each doctor
            $assignedClients = $clients->random(min(1, $clients->count()));

            foreach ($assignedClients as $client) {
                $doctor->clients()->syncWithoutDetaching($client->id);
            }
        }
    }
}
