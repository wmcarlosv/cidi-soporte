<?php

namespace App\Http\Controllers\Admin;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

use App\Departments;
use App\Role;
use App\User;
use App\Tickets;
use App\Files;
use App\Replies;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.staff.index',compact('users'));
    }

    /**
     * Create new resource.
     */
    public function create(){
        $departments = Departments::all();
        return view('admin.staff.add',compact('departments'));
    }


    /**
     * Add new resource to database.
     */
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:32',
            'username' => 'required|alpha_dash|max:100|unique:users',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6',
            'designation' => 'required',
        ]);
        $user  = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->designation = $request->designation;
        $user->department_id = $request->department;

        if(!empty($request->file)){
            $request->file->move('uploads', $request->file->getClientOriginalName());
            $user->avatar = $request->file->getClientOriginalName();
        }
        $user->save();
        $role = Role::where('name', 'staff')->first();
        $user->roles()->attach($role->id);
        return redirect::to('admin/staff')->withMessage('New staff member has been added');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        $departments = Departments::all();
        return view('admin.staff.edit', compact('user', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:32',
            'username' => 'required|max:32|unique:users,username,'.$id,
            'email' => 'email|max:40|unique:users,email,'.$id,
            'designation' => 'required',
        ]);


        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->designation = $request->designation;
        $user->department_id = $request->department;
        $user->save();
        if(!empty($request->file)){
            $request->file->move('uploads', $request->file->getClientOriginalName());
            $user->avatar = $request->file->getClientOriginalName();
        }



        if($request->role == 'admin'){
            $role = Role::where('name', 'admin')->first();
            $user->detachRoles($user->roles);
            $user->roles()->attach($role->id);
        }
        if($request->role == 'client'){
            $role = Role::where('name', 'client')->first();
            $user->detachRoles($user->roles);
            $user->roles()->attach($role->id);
        }
        if($request->role == 'staff'){
            $role = Role::where('name', 'staff')->first();
            $user->detachRoles($user->roles);
            $user->roles()->attach($role->id);
        }



        return redirect::to('admin/staff')->withMessage('Record has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tickets = Tickets::where('user_id', $id)->get();
        foreach ($tickets as $ticket){
            $files = Files::where('ticket_id' , $ticket->id)->get();
            foreach ($files as $file){
                Storage::delete($file->name);
            }
            Replies::where('ticket_id', $ticket->id)->delete();
            Files::where('ticket_id', $ticket->id)->delete();
        }
        Tickets::where('user_id', $id)->delete();
        User::find($id)->delete();
        return 'success';
    }
}
