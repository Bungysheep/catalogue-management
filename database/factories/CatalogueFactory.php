<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Catalogue;
use Faker\Generator as Faker;

$factory->define(Catalogue::class, function (Faker $faker) {
    return [
        'catalogue_code' => '$DEFAULT',
        'description' => 'Default Catalogue',
        'details' => 'Default Catalogue',
        'status' => 'A'
    ];
});
