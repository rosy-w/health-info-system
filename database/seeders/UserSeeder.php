<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
        ]);
        $admin->assignRole('admin');

        // Doctor user
        $doctor = User::create([
            'name' => 'Dr. Jane Doe',
            'email' => 'doctor@example.com',
            'password' => Hash::make('doctor'),
        ]);
        $doctor->assignRole('doctor');

    }
}
