<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' => 'Barry',
            'email' => 'barry@gmail.com',
            'password' => Hash::make("password"),
            'avatar' => 'default-avatar.jpg'
        ],[
            'name' => 'Larry',
            'email' => 'larry@gmail.com',
            'password' => Hash::make("password"),
            'avatar' => 'default-avatar.jpg'
        ],[
            'name' => 'Jerry',
            'email' => 'jerry@gmail.com',
            'password' => Hash::make("password"),
            'avatar' => 'default-avatar.jpg'
        ]]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make("password"),
            'avatar' => 'default-avatar.jpg',
            'is_admin' => true]);
    }
}
