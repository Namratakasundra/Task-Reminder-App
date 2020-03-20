<?php

namespace App\Http\Controllers\tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Category;
use App\Priority;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Show all tasks from the database and return to view
        $tasks = Task::with(['category','priority'])->sortable();
        $categories = Category::all();
        $priorities = Priority::all();
        $statuses = ['Pending', 'Completed', 'On Hold', 'Canceled'];
        $request_status = $request->query('status');
        $request_category = $request->query('category_id');
        $request_priority = $request->query('priority_id');
        $search = $request->query('search');
        //To search task
        if($request->search!= null)
        {
            $tasks = $tasks->where('details','like','%'.$search.'%');
        }
        //To filter category
        if($request->category_id != null)
        {
            $tasks= $tasks->where('category_id', $request_category);
        }
        //To filter priority 
        if($request->priority_id != null)
        {
            $tasks= $tasks->where('priority_id', $request_priority);
        }
        //To filter status
        if($request->status != null)
        {
            $tasks= $tasks->where('status', $request_status);
        }
        $tasks = $tasks->paginate(\Config::get('constants.pagination_size'));

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $tasks
            ];
        }
        return view('pages.tasks.index', compact('tasks', 'categories', 'priorities', 'statuses', 'request_category', 'request_priority', 'request_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tasks = new Task();
        $categories = Category::all();
        $priorities = Priority::all();
        $statuses = ['Pending', 'Completed', 'On Hold', 'Canceled'];

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $tasks
            ];
        }
        return view('pages.tasks.create', compact('tasks', 'categories', 'priorities', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            $task = new Task();
            $task->details = $request->input('details');
            $task->category_id = $request->input('category_id');
            $task->priority_id = $request->input('priority_id');
            $task->status = $request->input('status');
            $task->save(); 
            \Toastr::success('Task created successfully', 'Create', ["positionClass" => "toast-top-right"]); 
        } 
        catch (\Exception $e) 
        {
            dd($e);
        }

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $task
            ];
        }
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $task = Task::find($id);

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $tasks
            ];
        }
        return view('pages.tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $task = Task::find($id); //To find for edit Task 
        $tasks = Task::find($id); //To find Task in json data
        $categories = Category::all();
        $priorities = Priority::all();
        $statuses = ['Pending', 'Completed', 'On Hold', 'Canceled'];

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $tasks
            ];
        }
        return view('pages.tasks.create',compact('task', 'priorities', 'categories', 'statuses', 'tasks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try 
        {
            //Retrieve the Task and update
            $task = Task::find($id);
            $task->details = $request->input('details');
            $task->category_id = $request->input('category_id');
            $task->priority_id = $request->input('priority_id');
            $task->status = $request->input('status');
            $task->save(); //persist the data 
            \Toastr::success('Task updated successfully', 'Update', ["positionClass" => "toast-top-right"]);       
        } 
        catch (\Exception $e) 
        {
            dd($e);
        }

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $task
            ];
        }
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Retrieve the Task
        $task = Task::find($id);
        //delete
        $task->delete();
        \Toastr::success('Task Deleted successfully', 'Delete', ["positionClass" => "toast-top-right"]);

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $tasks
            ];
        }
        return redirect()->route('tasks.index');
    }
}