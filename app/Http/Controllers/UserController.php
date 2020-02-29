<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
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
        return view('pages.users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = ['Pending', 'Active', 'Inactive', 'Rejected', 'Blocked'];
        return view('pages.users.create',compact('statuses'));
    }

    public function search_user(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name','like','%'.$search.'%')->paginate(5);
        return view('pages.users.index',['users'=>$users]);
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
                $ImageUpload = \Image::make($file);
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.' .$extension;
                $user->profile_picture = $filename;
                $public_storage_path = 'app/public/';
                $path = 'users/' . $user->id . '/' .'profile_picture'. '/';
                $app_path = storage_path($public_storage_path . $path);
                $file->move($app_path, $filename);
                
                $sizes = [64, 128, 256, 512];
                foreach($sizes as $size)
                {
                    // for save thumbnail image
                    $public_storage_path = 'app/public/';
                    $thumbnailPath = 'users/' . $user->id . '/' .'profile_picture'. '/' .'thumbnail'. '/' .$size.'/'; 
                    $app_path = storage_path($public_storage_path . $thumbnailPath);                   

                    if (!file_exists($app_path)) {
                        \File::makeDirectory($app_path, 0777, true);
                    }
                    $ImageUpload->resize(null,$size, function ($constraint) {
                        $constraint->aspectRatio();
                    });    
                    $ImageUpload = $ImageUpload->save($app_path.$filename);
                }      
            }
           
            $user->update(); //persist the data 
            \Toastr::success('User created successfully', 'Create', ["positionClass" => "toast-top-center"]);
        } 
        catch (\Exception $e) 
        {
            dd($e);
        } 
        return redirect()->route('users.index');
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
        return view('pages.users.show',compact('user'));
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
        return view('pages.users.create',['user'=> $user], ['statuses'=> $statuses]);
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
        return redirect()->route('users.index');
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
        \Toastr::success('User Deleted successfully', 'Delete', ["positionClass" => "toast-top-center"], ["background-color" => "red"]);
        return redirect()->route('users.index');
    }
}
