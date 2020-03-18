<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use File;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Show all users from the database and return to view
        $users = User::sortable();
        $statuses = ['Pending', 'Active', 'Inactive', 'Rejected', 'Blocked'];
        $request_status = $request->query('status');
        $search = $request->query('search');
        if($request->search!= null)
        {
            $users = $users->where('name','like','%'.$search.'%');
        }
        //To filter status
        if($request->status != null)
        {
            $users= $users->where('status', $request_status);
        }
        $users = $users->paginate(\Config::get('constants.pagination_size'));
        return view('pages.users.index',compact('users', 'statuses', 'request_status'));

        if($request->ajax()){
            return response()->json();
        }
        return response('pages.users.index',compact('users', 'statuses', 'request_status'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|max:100|regex:/(^([a-zA-z]+)(\d+)?$)/u',
            'email' => 'required|email|unique:users,email',
            'password' =>'required|min:6',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        try 
        {
            $user = new User();
            //input method is used to get the value of input with its name specified
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->status = $request->input('status');
            $user->save(); 
            if($request->hasfile('profile_picture'))
            {
                //To save original image
                $file = $request->file('profile_picture');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.' .$extension;
                $user->profile_picture = $filename;

                $data = $request->profile_picture_data64;
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                
                $public_storage_path = 'app/public/';
                $path = 'users/' . $user->id . '/' .'profile_picture'. '/';
                $app_path = storage_path($public_storage_path . $path);

                if (!file_exists($app_path)) {
                    \File::makeDirectory($app_path, 0777, true);
                } 
                else 
                {
                    if ($delete_directory) {
                        \File::deleteDirectory($app_path, true);
                    }
                }
                
                file_put_contents($app_path .$filename, $data);

                $sizes = [64, 128, 256, 512];
                foreach($sizes as $size)
                {
                    // for save thumbnail image
                    $public_storage_path = 'app/public/';
                    $thumbnailPath = 'users/' . $user->id . '/' .'profile_picture'. '/' .'thumbnail'. '/' .$size.'/'; 
                    $thumbnailPath = storage_path($public_storage_path . $thumbnailPath);                   

                    if (!file_exists($thumbnailPath)) {
                        \File::makeDirectory($thumbnailPath, 0777, true);
                    }
                    \Image::make($app_path . '/' . $filename)->resize(null,$size, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbnailPath.$filename);
                }      
            }
           
            $user->update(); //persist the data 
            \Toastr::success('User created successfully', 'Create', ["positionClass" => "toast-top-right"]);
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
        request()->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'password' =>'required|min:6',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        try
        {
        //Retrieve the user and update
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));;
        $user->status = $request->input('status');
        $user->save(); //persist the data
        if($request->hasfile('profile_picture'))
        {
            //To delete existing image folder 
            $file = $request->file('profile_picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.' .$extension;
            $user->profile_picture = $filename;
            $public_storage_path = 'app/public/';
            $path = 'users/' . $user->id . '/';
            $app_path = storage_path($public_storage_path . $path);
            if (!file_exists($app_path)) {
                \File::makeDirectory($app_path, 0777, true);
            }
            File::deleteDirectory($app_path);
            
            //To save original image
            $file = $request->file('profile_picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.' .$extension;
            $user->profile_picture = $filename;
            $data = $request->profile_picture_data64;
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $public_storage_path = 'app/public/';
            $path = 'users/' . $user->id . '/' .'profile_picture'. '/';
            $app_path = storage_path($public_storage_path . $path);
            if (!file_exists($app_path)) {
                \File::makeDirectory($app_path, 0777, true);
            } 
            else 
            {
                if ($delete_directory) {
                    \File::deleteDirectory($app_path, true);
                }
            }
            file_put_contents($app_path .$filename, $data);
            
            $sizes = [64, 128, 256, 512];
            foreach($sizes as $size)
            {
                // for save thumbnail image
                $public_storage_path = 'app/public/';
                $thumbnailPath = 'users/' . $user->id . '/' .'profile_picture'. '/' .'thumbnail'. '/' .$size.'/'; 
                $thumbnailPath = storage_path($public_storage_path . $thumbnailPath);                   

                if (!file_exists($thumbnailPath)) {
                    \File::makeDirectory($thumbnailPath, 0777, true);
                }
                \Image::make($app_path . '/' . $filename)->resize(null,$size, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnailPath.$filename);
            }
        }
        
        $user->update(); //persist the data
        \Toastr::success('User updated successfully', 'Update', ["positionClass" => "toast-top-right"]);  
        }  
        catch (\Exception $e) 
        {
            dd($e);
        }   
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
        \Toastr::success('User Deleted successfully', 'Delete', ["positionClass" => "toast-top-right"]);
        return redirect()->route('users.index');
    }
}
