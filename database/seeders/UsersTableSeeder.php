<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'role'           => 'Admin',
                'password'       => Hash::make('1234'),
                'remember_token' => Null,
            ],
        ];

        User::insert($users);
    }
}
