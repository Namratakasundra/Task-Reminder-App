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
            'status' => 'Active',
        ]);

        $priority = Priority::create([
        	'name' => 'High', 
            'type' => 'Timebased',
            'status' => 'Inactive',
        ]);

        $priority = Priority::create([
        	'name' => 'Medium', 
            'type' => 'Custom',
            'status' => 'Active',
        ]);

        $priority = Priority::create([
        	'name' => 'Low', 
            'type' => 'Timebased',
            'status' => 'Inactive',
        ]);
    }
}
