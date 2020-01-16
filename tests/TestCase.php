<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function setUp() :void
    {
        parent::setUp();
        Artisan::call('passport:install', [ '-vvv' => true ]);
        Artisan::call('db:seed', [ '-vvv' => true ]);

        $user = factory(User::class)->create();
        $this->access_token = $user->createToken('catalogue-management-oauth')->accessToken;
    }
}
