<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            'admin',
            'doctor',
            'child',
            'pregnant-woman',
            'breastfeeding-woman',
            'organisation',
        ];

        foreach ($roles as $roleName) {
            Role::updateOrCreate(
                ['name' => $roleName, 'guard_name' => 'web']
            );
        }
    }
}
