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
    public function handle()
    {
        // $tasks = Task::all();
        //$tasks = \DB::Table('tasks')->select('priority_id')->where('priority_id',2)->get();
        $tasks = \DB::table('tasks')->where('priority_id', 2)->get();
        
        // $incomes_chart = DB::table('incomes')
        //             ->select(DB::raw('sum(amount) as y'),DB::raw('MONTHNAME(date) as label'),DB::raw('MONTH(date) as month'))
        //             ->groupBy(DB::raw('MONTHNAME(date)'),DB::raw('MONTH(date)'))->orderBy('month')->get();

        dd($tasks);
    }
}
