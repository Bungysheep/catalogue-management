<?php

use Illuminate\Database\Seeder;
use App\EntityAccess;

class EntityAccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityAccess::create([
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
