<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'role_code' => strtoupper($faker->unique()->word()),
        'description' => $faker->text(32),
        'details' => $faker->text(64),
        'status' => 'A'
    ];
});
