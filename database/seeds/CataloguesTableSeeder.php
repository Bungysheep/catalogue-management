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
        factory(Catalogue::class)->create();
    }
}
