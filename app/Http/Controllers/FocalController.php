<?php
namespace App\Http\Controllers;

use App\Complaints;
use App\Files;
use App\User;
use Illuminate\Http\Request;
use App\Comments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class FocalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $complaints = Complaints::all();
        $comments = Comments::orderBy('id', 'desc')->take(5)->get();
        return view("focal.index", compact('complaints', 'directors', 'comments'));
    }
    public function view($id)
    {
        $complaints = Complaints::where('id', $id)->get();
        $files = Files::where('complaint_id', $id)->get();
        foreach ($files as $items){
            if($items->user_id == null){
                $uploader = $items->complaints->complainant_name;
            }else{
                $uploader = $items->users->name;
            }
        }
        return view('focal.view', compact('complaints','files', 'uploader'));
    }
    public function complaintId($id)
    {
        $complaints = Complaints::where('id', $id)->get();
        $user_list = User::where('role_id', 3)->get();
        return view('focal.edit', compact('complaints','user_list'));
    }
    public function update(Request $request){
        $comments = new Comments();
        $complain = Complaints::find($request->id);
        if($request->status != null){
            $complain->status = $request->status;
        }
        if($request->assign != null){
            $complain->assign_to = $request->assign;
        }
        $complain->save();
        if(!empty($request->comment)) {
            $comments->comment = $request->comment;
            $comments->complaint_id = $request->id;
            $comments->user_id = Auth::id();
            $comments->complaint_status = $request->status;
            $comments->save();
        }
        if(Input::hasFile('file')){
            $files = new Files();
            $files->name = Input::file('file')->getClientOriginalName();
            $files->user_id = (Auth::user())? Auth::user()->id: null;
            $files->complaint_id = $request->id;
            $files->save();
            $file= Input::file('file');
            $file->move('uploads', $file->getClientOriginalName());
        }
        return Redirect()->back()->withSuccess('complaint updated successfully');
    }
    public function search(Request $request){
        $comments = Comments::orderBy('id', 'desc')->take(5)->get();

        if($request->date == null & $request->status == null & $request->user == null){
            return redirect::to("/home");
        }
        if(! empty($request->user)){
            $assigned_user = User::find($request->user);
        }else{
            $assigned_user = null;
        }
        $selection_date = $request->date;
        if($request == null){
            return redirect()->action('AdminController@index');
        }else {
            if ($request->date == 'all') {
                $date = 0;
            } elseif ($request->date == 'today') {
                $date = Carbon::today()->toDateString();
            } elseif ($request->date == 'yesterday') {
                $date = Carbon::yesterday()->toDateString();
            } elseif ($request->date == 'week') {
                $date = Carbon::now()->subWeeks(1)->toDateString();
            } elseif ($request->date == 'month') {
                $date = Carbon::now()->subMonth(1)->toDateString();;
            } else {
                $date = 0;
            }
            $status = (!empty($request->status)) ? $request->status : null;
            if ($request->date == 'today') {
                if ($status != null && $request->user == null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->get();
                }elseif($status != null && $request->user != null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->where('assign_to', '=', $request->user)->get();
                }
                else{
                    $complaints = Complaints::where('created_at', '>=', $date)->get();
                }
            }
            elseif ($request->date == 'yesterday') {
                if ($status != null && $request->user == null) {
                    $complaints = Complaints::where('created_at','LIKE', $date . '%')->where('status', '=', $status)->get();
                }elseif($status != null && $request->user != null) {
                    $complaints = Complaints::where('created_at','LIKE', $date . '%')->where('status', '=', $status)->where('assign_to', '=', $request->user)->get();
                }
                else{
                    $complaints = Complaints::where('created_at','LIKE', $date . '%')->get();
                }
            }
            elseif ($request->date == 'week') {
                if ($status != null && $request->user == null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->get();
                }elseif($status != null && $request->user != null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->where('assign_to', '=', $request->user)->get();
                }
                else{
                    $complaints = Complaints::where('created_at', '>=', $date)->get();
                }
            }
            elseif ($request->date == 'month') {
                if ($status != null && $request->user == null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->get();
                }elseif($status != null && $request->user != null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->where('assign_to', '=', $request->user)->get();
                }
                else{
                    $complaints = Complaints::where('created_at', '>=', $date)->get();
                }
            }
            if($status != null && $request->user == null && $date == 0){
                $complaints = Complaints::where('status', '=', $status)->get();
            }elseif($status == null && $request->user != null && $date == 0){
                $complaints = Complaints::where('assign_to', '=', $request->user)->get();
            }elseif($status != null && $request->user != null && $date == 0){
                $complaints = Complaints::where('status', '=', $status)->where('assign_to', '=', $request->user)->get();
            }
            $directors = User::where('role_id', 3)->get();

            return view("focal.index", compact('complaints','comments', 'directors', 'assigned_user','status', 'selection_date'));
        }
    }
    public function comments($id){
        $complaints = Complaints::where('id', $id)->get();
        $comments = Comments::where('complaint_id', $id)->get();
        return view('focal.comments', compact('comments', 'complaints'));
    }
    public function intimate(Request $request){
        if($request->complaint_id != null ){
            if($request->user_comment != null ){
                $comment = new Comments();
                $comment->user_comment = $request->user_comment;
                $comment->complaint_id = $request->complaint_id;
                $comment->user_id = Auth::user()->id;
                $comment->save();
            }
            $complaints = Complaints::find($request->complaint_id);
            $complaints->intimate = 'true';
            $complaints->save();

            $name = $complaints->complainant_name;
            $description = $request->description;
            Mail::send('mails.index',['name' => $name, 'description'=> $description], function ($message) use ($complaints, $request){
                $message->from('no-reply@gmail.com', 'Complaint Management System');
                $message->subject($request->subject);
                $message->to("wd@ppsc.com");
                $message->to($complaints->email );
            });
            $alert_class = 'success';
            $success_message = 'Email Sent Successfully!';
            return Redirect::to('/home')->with(compact('alert_class', 'success_message'));
        }
        $alert_class = 'danger';
        $danger_message = 'Email not Sent. Please choose a valid complaint !';
        return Redirect::to('/home')->with(compact('alert_class', 'danger_message'));
    }
    public function getComplain(Request $request){
        $complaint = Complaints::find($request->id);
        $output = '
                <strong>Email:</strong> '.$complaint->email.'<br>
                <strong>Subject:</strong> '.$complaint->Subject.'
        ';
        return $output;
    }
}