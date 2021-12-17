<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Auth;
use Hash;

class UserController extends Controller
{
    /**
     * Display Users List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $countPerPage = config('constants.paginate_per_page');
        $users = User::sortable()->paginate($countPerPage);
        return view('users/index', compact('users'),['name'=> 'Users List']);
    }

    /**
     * Create User Form
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users/create',['name'=> 'Create User Form']);
    }

    /**
     * User Confirmation
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(UserCreateRequest $request)
    {   

        $validatedData = $request->validated();

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $path =('image/');
            $file_name = time() . "." . $profile->getClientOriginalName();
            $profile->move($path, $file_name);
        }

        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'type' => $request->type,
            'dob' => $request->dob,
            'address' => $request->address,
            'profile' => $file_name,
          ];

        return view('users.confirm', compact('user'));

    }

    /**
     * User Data Store
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $path =('image/');
            $file_name = time() . "." . $profile->getClientOriginalName();
            $profile->move($path, $file_name);
        }
        $user = new User();
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile =  $request->profile;
        $user->type = $request->type;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->create_user_id = $request->create_user_id;
        
        $user->save();
        return redirect()->route('user.index');
    }

     /**
     * Show the form for editing post
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users/edit', ['name'=> 'Edit User Data'], compact('user'));
    }


    /**
     * Post Update Confirmation
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function updateConfirm(Request $request,User $user)
    {    
      
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'type' => 'required',
        ]);

        if ($request->hasfile('profile')) {
            $profile = $request->file('profile');
            $path =('image/');
            $file_name = time() . "." . $profile->getClientOriginalName();
            $profile->move($path, $file_name);
            $profile_name = $file_name; 
        } else {
            $profile_name = $user->profile;
        }
        
        $user = [
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'dob' => $request->dob,
            'address' => $request->address,
            'profile' => $profile_name,
            'updated_user_id' => $request->updated_user_id,
        ];
        
        return view('users/update_confirm', compact('user'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'profile' => 'required',
            'type' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required|max:255',
            'dob' => 'required',
            'updated_user_id' => 'required'
        ]);


           User::whereId($id)->update($validatedData);
           return redirect()->route('user.index')->with('success', 'User has been Updated'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * User Profile
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userProfile($id)
    {
        $user = User::findOrFail($id);

        return view('users/user_profile', ['name'=> 'User Profile'], compact('user'));
    }

    /**
     * Change Password Form
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordScreen($id)
    {
        $user = User::findOrFail($id);

        return view('users/change_password',['name'=> 'Change Password'], compact('user'));
    }

    /**
     * Change Password Function
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(UserCreateRequest $request)
    {

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match!');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password successfully changed!');
    }

    /**
     * Search Function
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userSearch(Request $request)
    {   
        $countPerPage = config('constants.paginate_per_page');
        $name = trim($request->get('name'));
        if ($name){
            $users = User::where('name','like',"%{$name}%")->paginate($countPerPage);
        }

        $email = trim($request->get('email'));
        if ($email){
            $users = User::where('email','like',"%{$email}%")->paginate($countPerPage);
        }

        $created_from = trim($request->get('created_from'));
        if ($created_from){
            $users = User::where('created_at','like',"%{$created_from}%")->paginate($countPerPage);
        }

        $created_to = trim($request->get('created_to'));
        if ($created_to){
            $users = User::where('created_at','like',"%{$created_to}%")->paginate($countPerPage);
        } 

        if ($created_from && $created_to)
        {
            $users = User::where('created_at','>=', $created_from)
                        ->where('created_at','<=', $created_to)
                        ->paginate($countPerPage);
        } 

        return view('users/search',compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   
        $user->deleted_user_id = Auth::user()->id;
        $user->save();
        $delete = $user->delete();
        
        return redirect()->route('user.index')->with('success', 'User has been Deleted');
    }
}
