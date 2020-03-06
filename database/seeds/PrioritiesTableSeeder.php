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
            'type' => 'Custom',
            'time' => '20',
            'status' => 'Active',
        ]);

        $priority = Priority::create([
        	'name' => 'High', 
            'type' => 'Timebased',
            'time' => '24',
            'status' => 'Inactive',
        ]);

        $priority = Priority::create([
        	'name' => 'Medium', 
            'type' => 'Custom',
            'time' => '36',
            'status' => 'Active',
        ]);

        $priority = Priority::create([
        	'name' => 'Low', 
            'type' => 'Timebased',
            'time' => '40',
            'status' => 'Inactive',
        ]);
    }
}
