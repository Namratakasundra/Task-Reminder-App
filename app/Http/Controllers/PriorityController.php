<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Priority;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all priorities from the database and return to view
        $priorities = Priority::sortable()->paginate(5);
        return view('pages.priorities.index',['priorities'=>$priorities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ['Custom','Timebased'];
        $statuses = ['Active', 'Inactive'];
        return view('pages.priorities.create', ['types'=>$types], ['statuses'=>$statuses]);
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
            $priority = new Priority();
            //input method is used to get the value of input with its
            //name specified
            $priority->name = $request->input('name');
            $priority->type = $request->input('type');
            $priority->time = $request->input('time');
            $priority->status = $request->input('status');
            $priority->save(); //persist the data 
            \Toastr::success('Priority created successfully', 'Create', ["positionClass" => "toast-top-center"]);
        }
        catch (\Exception $e) 
        {
            dd($e);
        }
        return redirect()->route('priorities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $priority = Priority::find($id);
        return view('pages.priorities.show',compact('priority'));
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
        $types = ['Custom','Timebased'];
        $statuses = ['Active', 'Inactive'];
        return view('pages.priorities.create',compact('priority', 'types', 'statuses'));
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
           //Retrieve the priority and update
            $priority = Priority::find($id);
            $priority->name = $request->input('name');
            $priority->type = $request->input('type');
            $priority->time = $request->input('time');
            $priority->status = $request->input('status');
            $priority->save(); //persist the data 
            \Toastr::success('Priority updated successfully', 'Update', ["positionClass" => "toast-top-center"]);       
        } 
        catch (\Exception $e) 
        {
            dd($e);
        }
        return redirect()->route('priorities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Retrieve the priority
        $priority = Priority::find($id);
        //delete
        $priority->delete();
        \Toastr::success('Priority Deleted successfully', 'Delete', ["positionClass" => "toast-top-center"], ["background-color" => "red"]);
        return redirect()->route('priorities.index');
    }
}
