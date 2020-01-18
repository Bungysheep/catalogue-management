<?php

use Illuminate\Database\Seeder;
use App\RoleAccess;

class RoleAccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleAccess::create([
            'role_code' => 'ADMIN',
            'entity_key' => 'CATALOGUE',
            'override_access' => [
                'read' => true,
                'create' => true,
                'update' => true,
                'delete' => true
            ]
        ]);

        RoleAccess::create([
            'role_code' => 'OFFICER',
            'entity_key' => 'CATALOGUE'
        ]);
    }
}
