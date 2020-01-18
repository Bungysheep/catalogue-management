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
            'entity_key' => 'CATALOGUE',
            'description' => 'Catalogue',
            'default_access' => [
                'read' => true,
                'create' => false,
                'update' => false,
                'delete' => false
            ]
        ]);
    }
}
