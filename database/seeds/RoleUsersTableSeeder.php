<?php

use Illuminate\Database\Seeder;
use App\RoleUsers;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleUsers::create([
            'user_id' => 1,
            'role_code' => 'ADMIN'
        ]);

        RoleUsers::create([
            'user_id' => 2,
            'role_code' => 'OFFICER'
        ]);
    }
}
