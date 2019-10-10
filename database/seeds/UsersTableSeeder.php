<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin
        \App\User::create([
            'name' => 'Administrator',
            'email' => 'superadmin@gmail.com',
            'role_id' => 1,
            'password' => bcrypt('123123123'),
        ]);
        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => 2,
            'password' => bcrypt('123123123'),
        ]);
        \App\User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'role_id' => 3,
            'password' => bcrypt('123123123'),
        ]);

        // Create test user
//        for ($i = 1; $i <= 50; $i++) {
//            $name = "user_" . $i;
//            \App\User::create([
//                'name' => $name,
//                'email' => $name . '@gmail.com',
//                'password' => bcrypt('123456'),
//            ]);
//        }
    }
}
