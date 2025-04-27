<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List all permissions on system
        $permissions = [
            //user management
            'create user',
            'edit user',
            'view user',
            'deactivate user',
            'delete user',

            //client management
            'create client',
            'view client',
            'edit client',
            'delete client',

            //program management
            'create program',
            'edit program',
            'view program',
            'deactivate program',
            'delete program',

            //enrollment management
            'create enrollment',
            'edit enrollment',
            'view enrollment',
            'deactivate enrollment',
            'delete enrollment',
        ];

        //initialize
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles & assign permissions
        $admin = Role::create(['name' => 'admin']);
        $doctor = Role::create(['name' => 'doctor']);

        // admin with all permissions
        $admin->syncPermissions(Permission::all());
        // Doctors can view/edit clients, view programs
        $doctor->syncPermissions([
            'create client',
            'view client',
            'edit client',
            'create program',
            'edit program',
            'view program',
            'create enrollment',
            'edit enrollment',
            'view enrollment',
            'deactivate enrollment'
        ]);
    }
}
