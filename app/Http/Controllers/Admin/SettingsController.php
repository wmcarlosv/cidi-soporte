<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Settings;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index(){
        $settings =  Settings::all()->first();
        return view('admin.settings.index', compact('settings'));

        
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'client_can_edit' => 'required',
            'staff_can_edit' => 'required',
            'ticket_email' => 'required',
            'copyrights' => 'required',
            'admin_email' => 'required',
            'description' => 'required',
            'footer_description' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
        ]);


        $settings = Settings::find($request->id);
        $settings->name = $request->name;
        $settings->keywords = $request->keywords;
        $settings->description = $request->description;
        $settings->footer_description = $request->footer_description;
        $settings->client_can_edit = $request->client_can_edit;
        $settings->staff_can_edit = $request->staff_can_edit;
        $settings->ticket_email = $request->ticket_email;
        $settings->admin_email = $request->admin_email;
        $settings->copyrights = $request->copyrights;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->linkedin = $request->linkedin;


        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $settings->logo = $file->getClientOriginalName();
            $file->move('uploads', $file->getClientOriginalName());
        }
        if ($request->hasFile('footer_logo')) {
            $file = $request->file('footer_logo');
            $settings->footer_logo = $file->getClientOriginalName();
            $file->move('uploads', $file->getClientOriginalName());
        }
        $settings->save();
        return redirect()->back()->withMessage('settings has been updated');

    }
}
