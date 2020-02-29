<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::create([
        	'name' => 'Home', 
        	'status' => 'Active',
        ]);

        $category = Category::create([
        	'name' => 'Office', 
        	'status' => 'Inactive',
        ]);

        $category = Category::create([
        	'name' => 'Personal', 
        	'status' => 'Active',
        ]);

        $category = Category::create([
        	'name' => 'Work', 
        	'status' => 'Inactive',
        ]);
    }
}
