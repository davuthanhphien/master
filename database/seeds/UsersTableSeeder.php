<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'master',
            'email' => 'master@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        DB::table('roles')->insert([
            'name' => 'master',
            'full' => '1',
        ]);
        DB::table('role_users')->insert([
            'role_id' => '1',
            'user_id' => '1',
        ]);
    }
}
