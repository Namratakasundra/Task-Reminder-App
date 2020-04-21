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
        	'email' => 'namratakasundra4@gmail.com',
            'password' => bcrypt('Uay7DZs523zZ5RGZ'),
            'status' => 'Active',
        ]);

        $user = User::create([
        	'name' => 'Priyanka Mehta', 
        	'email' => 'priyankamehta12797@gmail.com',
            'password' => bcrypt('jHUYbaYSW2Av4CSk'),
            'status' => 'Active',
        ]);

        $user = User::create([
        	'name' => 'Jhalak Javiya', 
        	'email' => 'jhalakjaviya@gmail.com',
            'password' => bcrypt('zncjK9Qax3CMFVtt'),
            'status' => 'Active',
        ]);

        $user = User::create([
        	'name' => 'Kapeel Patel', 
        	'email' => 'matrixmob@gmail.com',
            'password' => bcrypt('KzCL3cgU8p78Kvxz'),
            'status' => 'Active',
        ]);
    }
}
