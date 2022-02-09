<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function profile(){
        $user = User::find(Auth::id());
        return view('profile.index', compact('user'));
    }

    public function updateProfile(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:32',
            'username' => 'required|max:32|unique:users,username,'.Auth::id(),
            'email' => 'email|max:40|unique:users,email,'.Auth::id()
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if(!empty($request->file)){
            $request->file->move('uploads', $request->file->getClientOriginalName());
            $user->avatar = $request->file->getClientOriginalName();
        }
        $user->save();
        return redirect()->back()->withMessage('Profile updated successfully');
    }

    public function resetPassword(){
        return view('profile.reset_password');
    }


    public function updatePassword(Request $request) {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        $user = User::find(Auth::id());
        if(Hash::check($request->old_password, $user->password)){
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back()->withMessage("password changed successfully");
        }
        else
            return redirect()->back()->withError("Current password doesn't match");

    }





}
