<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Catalogue;
use Faker\Generator as Faker;

$factory->define(Catalogue::class, function (Faker $faker) {
    return [
        'catalogue_code' => strtoupper($faker->unique()->word()),
        'description' => $faker->text(32),
        'details' => $faker->text(255),
        'status' => 'A'
    ];
});
