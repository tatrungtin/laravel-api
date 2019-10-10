<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = \App\Role::create([
            'name' => 'SuperAdmin ', 
            'permissions' => null
        ]);
        $admin = \App\Role::create([
            'name' => 'Admin', 
            'permissions' => [
                'users.update',
                'users.index',
                'users.edit',
                'users.destroy',
                'users.store',
            ]
        ]);
        $user = \App\Role::create([
            'name' => 'User', 
            'permissions' => [
                'users.index'
            ]
        ]);
    }
}
