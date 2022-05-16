<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@site.com',
                'password' => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id' => 2,
                'name' => 'User',
                'email' => 'user@site.com',
                'password' => bcrypt('password'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}