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

        $admin = User::find(1);
        $officer = User::find(2);
        $this->admin_access_token = $admin->createToken('admin-oauth')->accessToken;
        $this->officer_access_token = $officer->createToken('admin-oauth')->accessToken;
    }
}
