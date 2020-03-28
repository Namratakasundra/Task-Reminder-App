<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Task;
use App\Category;
use App\Priority;

class ChangeTasksStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ChangeTasksStatus:status';

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
    public function handle(Request $request)
    {
        $tasks = Task::all();
        dd($tasks);
    }
}
