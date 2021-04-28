<?php

use Illuminate\Database\Seeder;
use App\User;
use App\role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = role::where('name','user')->first();
        $role_admin = role::where('name','admin')->first();

        $user = new User();
        $user->name = "Usuario Default";
        $user->email = "user@mail.com"; 
        $user->password = bcrypt('user');
        $user->slug = time()."user"; 
        $user->save();
        $user->roles()->attach($role_user);
        
        $user = new User();
        $user->name = "Administrador";
        $user->email = "admin@mail.com";
        $user->password = bcrypt('admin');
        $user->slug = time()."admin"; 
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
