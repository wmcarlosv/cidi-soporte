<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function viewUsers()
    {
        $users = User::all();
        return View('admin.user.all_users',compact('users'));
    }


    public function deleteUsers($id){

        User::where('id', $id)->delete();
    }

    public function editUsers($id){
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function updateUsers(Request $request, $id){
        $user = User::find($id);
        $user->id = $request->id;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();
        
        
        
        
        return redirect()->back();
    }
}
