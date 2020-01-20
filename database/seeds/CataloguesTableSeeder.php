<?php

use Illuminate\Database\Seeder;
use App\Models\Catalogue;

class CataloguesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Catalogue::create([
            'catalogue_code' => '$DEFAULT',
            'description' => 'Default Catalogue',
            'details' => 'Default Catalogue',
            'status' => 'A'
        ]);
    }
}
