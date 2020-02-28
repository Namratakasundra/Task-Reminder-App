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
    public function index()
    {
        //Show all tasks from the database and return to view
        $tasks = Task::sortable()->paginate(5);
        return view('task.index',['tasks'=>$tasks]);
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
        return view('task.create', compact('categories', 'statuses', 'priorities'));
    }

    public function search_task(Request $request)
    {
        $search = $request->get('search');
        $tasks = Task::where('details','like','%'.$search.'%')->paginate(5);
        return view('task.index',['tasks'=>$tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        //input method is used to get the value of input with its
        //name specified
        $task->details = $request->input('details');
        $task->category_id = $request->input('category_id');
        $task->priority_id = $request->input('priority_id');
        $task->status = $request->input('status');
        $task->save(); //persist the data 
        \Toastr::success('Task created successfully', 'Create', ["positionClass" => "toast-top-center"]);
        return redirect()->route('task.index');
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
        return view('task.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find the Priority
        $priority = Priority::find($id);
        $statuses = ['Pending', 'Completed', 'On Hold', 'Canceled'];
        return view('priority.create',compact('priority', 'statuses'));
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
        //Retrieve the Task and update
        $task = Task::find($id);
        $task->details = $request->input('details');
        $task->category_id = $request->input('category_id');
        $task->priority_id = $request->input('priority_id');
        $task->status = $request->input('status');
        $task->save(); //persist the data 
        \Toastr::success('Task updated successfully', 'Update', ["positionClass" => "toast-top-center"]);       
        return redirect()->route('task.index');
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
        return redirect()->route('task.index');
    }
}
