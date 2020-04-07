<?php

use Illuminate\Database\Seeder;
Use App\Priority;

class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priority = Priority::create([
        	'name' => 'Urgent', 
            'time' => '24',
            'status' => 'Active',
        ]);

        $priority = Priority::create([
        	'name' => 'High', 
            'time' => '48',
            'status' => 'Active',
        ]);

        $priority = Priority::create([
        	'name' => 'Medium', 
            'time' => '96',
            'status' => 'Active',
        ]);

        $priority = Priority::create([
        	'name' => 'Low', 
            'time' => '168',
            'status' => 'Active',
        ]);
    }
}
