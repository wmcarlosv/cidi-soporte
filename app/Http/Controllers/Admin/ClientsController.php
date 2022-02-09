<?php

namespace App\Http\Controllers\Admin;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

use App\Role;
use App\User;
use App\Tickets;
use App\Files;
use App\Replies;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::Paginate(15);
        return view('admin.clients.index',compact('users'));
    }

    /**
     * Create new resource.
     */
    public function create(){
        return view('admin.clients.add');
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
        ]);
        $user  = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if(!empty($request->file)){
            $request->file->move('uploads', $request->file->getClientOriginalName());
            $user->avatar = $request->file->getClientOriginalName();
        }
        $user->save();
        $role = Role::where('name', 'client')->first();
        $user->roles()->attach($role->id);
        return redirect::to('admin/clients')->withMessage('New client has been added');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.clients.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if(!empty($request->file)){
            $request->file->move('uploads', $request->file->getClientOriginalName());
            $user->avatar = $request->file->getClientOriginalName();
        }

        $user->save();
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

        return redirect::to('admin/clients')->withMessage('Record has been updated');
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
