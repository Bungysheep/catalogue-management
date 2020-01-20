<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EntityAccess;
use Faker\Generator as Faker;

$factory->define(EntityAccess::class, function (Faker $faker) {
    return [
        'entity_key' => strtoupper($faker->unique()->word()),
        'description' => $faker->text(32),
        'default_access' => [
            'read' => true,
            'create' => false,
            'update' => false,
            'delete' => false
        ]
    ];
});
