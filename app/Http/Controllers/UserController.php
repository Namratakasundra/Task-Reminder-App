<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all users from the database and return to view
        $users = User::sortable()->paginate(5);
        return view('user.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = ['Pending', 'Active', 'Inactive', 'Rejected', 'Blocked'];
        return view('user.create',compact('statuses'));
    }

    public function search_user(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name','like','%'.$search.'%')->paginate(5);
        return view('user.index',['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        try {
            $user = new User();
            //input method is used to get the value of input with its
            //name specified
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->status = $request->input('status');
            $user->save(); 
            if($request->hasfile('profile_picture'))
            {
                //To save original image
                $file = $request->file('profile_picture');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.' .$extension;
                $user->profile_picture = $filename;
                $public_storage_path = 'app/public/';
                $path = 'users/' . $user->id . '/' .'profile_picture'. '/';
                $app_path = storage_path($public_storage_path . $path);                
                $file->move($app_path, $filename);

               /*  $sizes = [64, 128, 256, 512];

                foreach($sizes as $size)
                {
                    // for save thumbnail image
                    $thumbnailPath = public_path('users/' . $user->id . '/' .'profile_picture'. '/' .'thumbnail'. '/' .$size.'/');

                    if (!file_exists($thumbnailPath)) {
                        \File::makeDirectory($thumbnailPath, 0777, true, true);
                    }
                    
                    $file->path($app_path, $filename);
                    $image= $request->file($file);
                    //dd($filename,$thumbnailPath);
                    //dd($request->files);
                    $file->resize(null, $size, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    dd('done');
                    $file = $file->save($thumbnailPath.$filename.$files->getClientOriginalName());
                } */
            }
            else
            {
            }
            $user->update(); //persist the data 
            \Toastr::success('User created successfully', 'Create', ["positionClass" => "toast-top-center"]);
        } 
        catch (\Exception $e) 
        {
            dd($e);
        } 
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find the user
        $user = User::find($id);
        $statuses  = ['Pending', 'Active', 'Inactive', 'Rejected', 'Blocked'];
        return view('user.create',['user'=> $user], ['statuses'=> $statuses]);
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
        //Retrieve the user and update
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->status = $request->input('status');
        $user->save(); //persist the data
        if($request->hasfile('profile_picture'))
        {
            $file = $request->file('profile_picture');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.' .$extension;
                $user->profile_picture = $filename;
                $public_storage_path = 'app/public/';
                $path = 'users/' . $user->id . '/' .'profile_picture'. '/';
                $app_path = storage_path($public_storage_path . $path);                
                $file->move($app_path, $filename);
        }
        else
        {
        }
        $user->update(); //persist the data
        \Toastr::success('User updated successfully', 'Update', ["positionClass" => "toast-top-center"]);       
        return redirect()->route('user.index');
    }

    /**`
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Retrieve the user
        $user = User::find($id);
        //delete
        $user->delete();
        \Toastr::error('User Deleted successfully', 'Delete', ["positionClass" => "toast-top-center"], ["background-color" => "red"]);
        return redirect()->route('user.index');
    }
}
