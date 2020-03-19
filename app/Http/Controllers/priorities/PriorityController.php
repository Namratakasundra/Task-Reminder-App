<?php

namespace App\Http\Controllers\priorities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Priority;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Show all priorities from the database and return to view
        $priorities = Priority::sortable();
        $statuses = ['Active', 'Inactive'];
        $request_status = $request->query('status');
        $search = $request->query('search');
        if($request->search!= null)
        {
            $priorities = $priorities->where('name','like','%'.$search.'%');
        }
        //To filter status
        if($request->status != null)
        {
            $priorities= $priorities->where('status', $request_status);
        }
        $priorities = $priorities->paginate(\Config::get('constants.pagination_size'));

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $priorities
            ];
        }
        return view('pages.priorities.index',compact('priorities', 'statuses', 'request_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $types = ['Custom','Timebased'];
        $statuses = ['Active', 'Inactive'];
        $priorities = new Priority();

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $priorities
            ];
        }
        return view('pages.priorities.create', ['types'=>$types], ['statuses'=>$statuses], ['priorities'=>$priorities]);
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
            \Toastr::success('Priority created successfully', 'Create', ["positionClass" => "toast-top-right"]);
        }
        catch (\Exception $e) 
        {
            dd($e);
        }

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $priorities
            ];
        }
        return redirect()->route('priorities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $priority = Priority::find($id);

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $priorities
            ];
        }
        return view('pages.priorities.show',compact('priority'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //Find the Priority
        $priority = Priority::find($id);//To find for edit Priority 
        $priorities = Priority::find($id);//To find Priority in json data
        $types = ['Custom','Timebased'];
        $statuses = ['Active', 'Inactive'];

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $priorities
            ];
        }
        return view('pages.priorities.create',compact('priority', 'types', 'statuses', 'priorities'));
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
            \Toastr::success('Priority updated successfully', 'Update', ["positionClass" => "toast-top-right"]);       
        } 
        catch (\Exception $e) 
        {
            dd($e);
        }

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $priorities
            ];
        }
        return redirect()->route('priorities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Retrieve the priority
        $priority = Priority::find($id);
        //delete
        $priority->delete();
        \Toastr::success('Priority Deleted successfully', 'Delete', ["positionClass" => "toast-top-right"]);

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $priorities
            ];
        }
        return redirect()->route('priorities.index');
    }
}
