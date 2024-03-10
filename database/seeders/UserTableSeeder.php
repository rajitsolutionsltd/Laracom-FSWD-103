<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => bcrypt(123456), 'user_type' => 'admin'],
            ['name' => 'Customer', 'email' => 'customer@gmail.com', 'password' => bcrypt(123456), 'user_type' => 'customer']
        ];

        foreach ($users as $user) {
            $new_user = new User;
            $new_user->name = $user['name'];
            $new_user->email = $user['email'];
            $new_user->password = $user['password'];
            $new_user->user_type = $user['user_type'];
            $new_user->save();
        }
    }
}
