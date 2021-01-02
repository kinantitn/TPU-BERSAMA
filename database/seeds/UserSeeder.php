<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin TPU',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'remember_token' => Str::random(80),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
