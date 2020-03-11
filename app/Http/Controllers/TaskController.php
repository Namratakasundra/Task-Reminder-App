<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $tasks = Task::sortable();
        $categories = Category::with(['category_name','Category','name']);
        $priorities = Priority::with(['priority_name','Priority','name']);
        $search = $request->query('search');
        if($request->search!= null)
        {
            $tasks = $tasks->where('details','like','%'.$search.'%');
        }
        $tasks = $tasks->paginate(\Config::get('constants.pagination_size'));
        return view('pages.tasks.index', compact('tasks', 'categories', 'priorities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $priorities = Priority::all();
        $statuses = ['Pending', 'Completed', 'On Hold', 'Canceled'];
        return view('pages.tasks.create', compact('categories', 'priorities', 'statuses'));
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
            \Toastr::success('Task created successfully', 'Create', ["positionClass" => "toast-top-center"]); 
        } 
        catch (\Exception $e) 
        {
            dd($e);
        }
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('pages.tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $categories = Category::all();
        $priorities = Priority::all();
        $statuses = ['Pending', 'Completed', 'On Hold', 'Canceled'];
        return view('pages.tasks.create',compact('task', 'priorities', 'categories', 'statuses'));
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
            \Toastr::success('Task updated successfully', 'Update', ["positionClass" => "toast-top-center"]);       
        } 
        catch (\Exception $e) 
        {
            dd($e);
        }
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Retrieve the Task
        $task = Task::find($id);
        //delete
        $task->delete();
        \Toastr::success('Task Deleted successfully', 'Delete', ["positionClass" => "toast-top-center"], ["background-color" => "red"]);
        return redirect()->route('tasks.index');
    }
}
