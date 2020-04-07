<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Task;
use App\Category;
use App\Priority;
use Carbon\Carbon;

class ChangeTasksStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will change the status of task';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tasks = Task::all();

        //Get task which priority is high
        $tasks = \DB::table('tasks')->where('priority_id', 2)->get();

        // $time_formatted = new Carbon();
        // $time = $time_formatted->startTime()->format('%H:%I:%S');
        // $time_end = $time_formatted->finishTime()->format('%H:%I:%S');
        
        dd($tasks);
    }
}
