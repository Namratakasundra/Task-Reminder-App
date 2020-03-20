<?php

namespace App\Http\Controllers\categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Show all categories from the database and return to view
        $categories = Category::sortable();
        $statuses = ['Active', 'Inactive'];
        $request_status = $request->query('status');
        $search = $request->query('search');
        if($request->search!= null)
        {
            $categories = $categories->where('name','like','%'.$search.'%');
        }
        //To filter status
        if($request->status != null)
        {
            $categories= $categories->where('status', $request_status);
        }
        $categories = $categories->paginate(\Config::get('constants.pagination_size'));

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $categories
            ];
        }
        return view('pages.categories.index', compact('categories', 'statuses', 'request_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $statuses = ['Active', 'Inactive'];
        $categories = new Category();

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $categories
            ];
        }
        return view('pages.categories.create',compact('statuses', 'categories'));
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
            $category = new Category();
            //input method is used to get the value of input with its
            //name specified
            $category->name = $request->input('name');
            $category->status = $request->input('status');
            $category->save(); //persist the data 
            \Toastr::success('Category Created successfully', 'Create', ["positionClass" => "toast-top-right"]);       
        } 
        catch (\Exception $e) 
        {
            dd($e);
        }

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $category
            ];
        }
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $category = Category::find($id);

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $category
            ];
        }
        return view('pages.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //Find the category
        $category = Category::find($id);
        $statuses  = ['Active', 'Inactive'];

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $category
            ];
        }
        return view('pages.categories.create', ['category'=> $category], ['statuses'=> $statuses]);
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
            //Retrieve the category and update
            $category = Category::find($id);
            $category->name = $request->input('name');
            $category->status = $request->input('status');
            $category->save(); //persist the data 
            \Toastr::success('Category updated successfully', 'Update', ["positionClass" => "toast-top-right"]);          
        } 
        catch (\Exception $e) 
        {
            dd($e);
        }

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $category
            ];
        }
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Retrieve the category
        $category = Category::find($id);
        //delete
        $category->delete();
        \Toastr::success('Category Deleted successfully', 'Delete', ["positionClass" => "toast-top-right"]);
        
        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $categories
            ];
        }
        return redirect()->route('categories.index');
    }
}
