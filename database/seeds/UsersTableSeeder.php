<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Namrata kasundra', 
        	'email' => 'namu@gmail.com',
            'password' => bcrypt('123456'),
            'status' => 'Active',
        ]);

        $user = User::create([
        	'name' => 'Bunny Jivani', 
        	'email' => 'bunny@gmail.com',
            'password' => bcrypt('123456'),
            'status' => 'Inactive',
        ]);

        $user = User::create([
        	'name' => 'Shruti Patel', 
        	'email' => 'shruti@gmail.com',
            'password' => bcrypt('123456'),
            'status' => 'Rejected',
        ]);

        $user = User::create([
        	'name' => 'Chintu Patel', 
        	'email' => 'chintu@gmail.com',
            'password' => bcrypt('123456'),
            'status' => 'Pending',
        ]);

        $user = User::create([
        	'name' => 'Beena Patel', 
        	'email' => 'beena@gmail.com',
            'password' => bcrypt('123456'),
            'status' => 'Blocked',
        ]);
    }
}
