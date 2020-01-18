<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_code' => 'ADMIN',
            'description' => 'Admin',
            'details' => 'Admin',
            'status' => 'A'
        ]);

        Role::create([
            'role_code' => 'OFFICER',
            'description' => 'Officer',
            'details' => 'Officer',
            'status' => 'A'
        ]);
    }
}
