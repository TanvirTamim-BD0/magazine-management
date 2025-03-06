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
                'id'             => 1,
                'name'           => 'Admin',
                'phone'           => '01700000000',
                'email'          => 'admin@admin.com',
                'role'           => 'Admin'
                'password'       => bcrypt('1234'),
                'remember_token' => Null,
            ],
        ];

        User::insert($users);
    }
}
