<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all categories from the database and return to view
        $categories = Category::sortable()->paginate(5);
        return view('category.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = ['Active', 'Inactive'];
        return view('category.create',compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        //input method is used to get the value of input with its
        //name specified
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->save(); //persist the data 
        \Toastr::success('Category Created successfully', 'Create', ["positionClass" => "toast-top-center"]);       
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find the category
        $category = Category::find($id);
        $statuses  = ['Active', 'Inactive'];
        return view('category.create',['category'=> $category], ['statuses'=> $statuses]);
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
        //Retrieve the category and update
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->save(); //persist the data 
        \Toastr::success('Category updated successfully', 'Update', ["positionClass" => "toast-top-center"]);       
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Retrieve the category
        $category = Category::find($id);
        //delete
        $category->delete();
        \Toastr::success('Category Deleted successfully', 'Delete', ["positionClass" => "toast-top-center"], ["background-color" => "red"]);
        return redirect()->route('category.index');
    }
}
