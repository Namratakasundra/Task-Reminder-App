<?php

namespace App\Http\Controllers\User;

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
        
        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $users
            ];
        }
        return view('pages.users.index', compact('users', 'statuses', 'request_status'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $statuses = ['Pending', 'Active', 'Inactive', 'Rejected', 'Blocked'];
        $users = new User();

        // if($request->is('api/*')) 
        // {
        //     return [
        //         'status' => true,
        //         'data' => $users
        //     ];
        // }
        return view('pages.users.create',compact('statuses', 'users'));
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
            'name' => ['required', 'max:100', 'regex:/(^[a-zA-Z]+(\s[a-zA-Z]+)?$)/u'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                //'regex:/[@$!%*#?&]/', // must contain a special character
                ],
            'confirm_password' => ['required_with:password', 'min:6', 'same:password'],
            'profile_picture' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        // request()->validate([
        //         'name' => ['required', 'alpha'],
        //         'email' => ['required', 'string', 'email'],
        //         'password' => ['required', 'string', 'min:6', 'confirmed',
        //         'regex:/[a-z]/',      // must contain at least one lowercase letter
        //         'regex:/[A-Z]/',      // must contain at least one uppercase letter
        //         'regex:/[0-9]/',      // must contain at least one digit
        //         // 'regex:/[@$!%*#?&]/', // must contain a special character
        //         ],
        //         // 'password' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        //     ]);

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
                // $file->move($app_path, $filename);

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

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $user
            ];
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

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $user
            ];
        }
        return view('pages.users.show',compact('user'));
    }

    public function password(Request $request, $id)
    {
        $user = User::find($id);
        return view('pages.users.password',compact('user'));
    }

    public function savepassword(Request $request, $id)
    {
        try 
        {
            request()->validate([
                'password' => ['required', 'string', 'min:6', 'confirmed',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                //'regex:/[@$!%*#?&]/', // must contain a special character
                ],
                'confirm_password' => ['required_with:password', 'min:6', 'same:password'],
            ]);
            
            $user = User::find($id);
            $user->password = bcrypt($request->input('password'));
            $user ->save();    
            \Toastr::success('Password successfully changed', 'Password change', ["positionClass" => "toast-top-right"]);        
        } 
        catch (Exception $e) 
        {
            report($e);
            return false;
        }
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //Find the user
        $user = User::find($id); 
        $statuses  = ['Pending', 'Active', 'Inactive', 'Rejected', 'Blocked'];

        // if($request->is('api/*')) 
        // {
        //     return [
        //         'status' => true,
        //         'data' => $user
        //     ];
        // }
        return view('pages.users.create', ['user'=> $user], ['statuses'=> $statuses]);
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
            'name' => ['required', 'max:100', 'regex:/(^[a-zA-Z]+(\s[a-zA-Z]+)?$)/u'],
            'email' => ['required', 'email'],
            'profile_picture' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        try
        {
        //Retrieve the user and update
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
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
        
        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $user
            ];
        }
        return redirect()->route('users.index');
    }

    /**`
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Retrieve the user
        $user = User::find($id);
        //delete
        $user->delete();
        \Toastr::success('User Deleted successfully', 'Delete', ["positionClass" => "toast-top-right"]);

        if($request->is('api/*')) 
        {
            return [
                'status' => true,
                'data' => $users
            ];
        }
        return redirect()->route('users.index');
    }
}
