<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function about(){
        return view('pages.about');
    }

    public function contact(){
        return view('pages.contact');
    }

    public function contactMail(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'description' => 'required|min:15|max:10000'
        ]);
        $settings = Settings::all()->first();
        Mail::send('mails.contact',['request'=>$request], function ($message) use ($settings){
            $message->from('no-reply@gmail.com', 'Ticket Plus New Contact');
            $message->subject('New Contact');
            $message->to($settings->admin_email);
        });
        return redirect()->back()->withMessage('Contact form submitted. We will get back to you soon.');
    }

}
