<?php

use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	User::truncate();
    	DB::table('role_user')->truncate();

        $adminRole = Role::where('name','admin')->first();
        $authorRole = Role::where('name','author')->first();
        $userRole = Role::where('name','user')->first();

        $admin = User::create([
        	'name'	=>	'AdminUser',
        	'email'	=>	'adminuser@gmail.com',
        	'password'	=>	Hash::make('password')
        ]);

        $author = User::create([
        	'name'	=>	'AuthorUser',
        	'email'	=>	'authoruser@gmail.com',
        	'password'	=>	Hash::make('password')
        ]);

        $user = User::create([
        	'name'	=>	'User',
        	'email'	=>	'user@gmail.com',
        	'password'	=>	Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);
    }
}
