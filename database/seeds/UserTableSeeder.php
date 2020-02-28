<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
        	'password' => bcrypt('123456')
        ]);

        $user = User::create([
        	'name' => 'Bunny kasundra', 
        	'email' => 'bunny@gmail.com',
        	'password' => bcrypt('123456')
        ]);

        $user = User::create([
        	'name' => 'Bunny Patel', 
        	'email' => 'bunny11@gmail.com',
        	'password' => bcrypt('123456')
        ]);
    }
}
