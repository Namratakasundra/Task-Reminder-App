<?php

use Illuminate\Database\Seeder;
use App\Category;

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
        	'status' => 'Active',
        ]);

        $category = Category::create([
        	'name' => 'Personal', 
        	'status' => 'Active',
        ]);

        $category = Category::create([
        	'name' => 'Work', 
        	'status' => 'Active',
        ]);
    }
}
