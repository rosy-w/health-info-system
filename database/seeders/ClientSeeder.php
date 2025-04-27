<?php

namespace Database\Seeders;

use App\Models\Client;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'name' => 'Jane Otieno',
            'id_number' => '39897828',
            'email' => 'jane@example.com',
            'phone' => '0795948578',
            'address' => 'Langata',
            'city' => 'Nairobi',
            'dob' => '2000-01-01',
        ]);

        Client::create([
            'name' => 'Mike Waweru',
            'id_number' => '2897728',
            'email' => 'mike@example.com',
            'phone' => '0795948578',
            'address' => 'Kilimani',
            'city' => 'Nairobi',
            'dob' => '1997-03-01',
        ]);
    }
}
