<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
       $role_user->name = 'user';
       $role_user->description = 'A User';
       $role_user->save();

       $role_manager = new Role();
       $role_manager->name = 'admin';
       $role_manager->description = 'A Admin User';
       $role_manager->save();
    }
}