<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [

    ];
});

$factory->state(Role::class, 'admin', function (Faker $faker) {
    return [
        'role_code' => 'ADMIN',
        'description' => 'Admin',
        'details' => 'Admin',
        'status' => 'A'
    ];
});

$factory->state(Role::class, 'officer', function (Faker $faker) {
    return [
        'role_code' => 'OFFICER',
        'description' => 'Officer',
        'details' => 'Officer',
        'status' => 'A'
    ];
});
