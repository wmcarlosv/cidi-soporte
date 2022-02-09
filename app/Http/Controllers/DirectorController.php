<?php

namespace App\Http\Controllers;

use App\Complaints;
use App\Files;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DirectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dt = Carbon::now();
        $complaint_status = Complaints::where('created_at', '<', $dt->subDays(3))->get();
        if($complaint_status->count()){
            foreach ($complaint_status as $complaint){
                $updates = Complaints::find($complaint->id);
                if($updates->status != 'closed'){
                    $updates->status = 'over due';
                    $updates->save();
                }
            }
        }
        $complaints = Complaints::where('assign_to', Auth::user()->id)->get();
        $directors = User::where('role_id', 3)->get();
        return view("directors.index", compact('complaints', 'directors'));
    }

    public function complaintId(Request $request)
    {
        $complaints = Complaints::where('id', $request->id)->get();
        foreach ($complaints as $items){
            $output = '            
            <input type="hidden" name="id" value="'.$items->id.'">
              <div class="form-group">
                <select class="form-control" name="status">
                    <option value="">Select</option>
                    <option value="Closed">Closed</option>
                    <option value="Under Process">Under Process</option>
                </select>
            </div>
            
             <div class="form-group">
                <label class="control-label">Attach File:</label>
                <input type="file" class="form-control" name="file" />
                 <span class="help-block" id="file"></span>
             </div>
              <div class="form-group">
                <label>Add Comment</label>
                <textarea class="form-control" name="comment"></textarea>
            </div>
                   ';
        }
        return $output;
    }


    public function search(Request $request){
        $comments = Comments::orderBy('id', 'desc')->take(5)->get();
        if($request->date == null & $request->status == null){
            return redirect::to("/director");
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
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->where('assign_to', Auth::id())->get();
                }elseif($status != null && $request->user != null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->where('assign_to', '=', $request->user)->get();
                }
                else{
                    $complaints = Complaints::where('created_at', '>=', $date)->where('assign_to', Auth::id())->get();
                }
            }
            elseif ($request->date == 'yesterday') {
                if ($status != null && $request->user == null) {
                    $complaints = Complaints::where('created_at','LIKE', $date . '%')->where('status', '=', $status)->where('assign_to', Auth::id())->get();
                }elseif($status != null && $request->user != null) {
                    $complaints = Complaints::where('created_at','LIKE', $date . '%')->where('status', '=', $status)->where('assign_to', '=', $request->user)->get();
                }
                else{
                    $complaints = Complaints::where('created_at','LIKE', $date . '%')->where('assign_to', Auth::id())->get();
                }
            }
            elseif ($request->date == 'week') {
                if ($status != null && $request->user == null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->where('assign_to', Auth::id())->get();
                }elseif($status != null && $request->user != null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->where('assign_to', '=', $request->user)->get();
                }
                else{
                    $complaints = Complaints::where('created_at', '>=', $date)->where('assign_to', Auth::id())->get();
                }
            }
            
            elseif ($request->date == 'month') {
                if ($status != null && $request->user == null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->where('assign_to', Auth::id())->get();
                }elseif($status != null && $request->user != null) {
                    $complaints = Complaints::where('created_at', '>=', $date)->where('status', '=', $status)->where('assign_to', '=', $request->user)->get();
                }
                else{
                    $complaints = Complaints::where('created_at', '>=', $date)->where('assign_to', Auth::id())->get();
                }
            }
            if($status != null && $request->user == null && $date == 0){
                $complaints = Complaints::where('status', '=', $status)->where('assign_to', Auth::id())->get();
            }elseif($status == null && $request->user != null && $date == 0){
                $complaints = Complaints::where('assign_to', '=', $request->user)->where('assign_to', Auth::id())->get();
            }elseif($status != null && $request->user != null && $date == 0){
                $complaints = Complaints::where('status', '=', $status)->where('assign_to', '=', $request->user)->get();
            }
            $directors = User::where('role_id', 3)->get();
            return view("directors.index", compact('complaints','comments', 'directors', 'assigned_user','status', 'selection_date'));
        }
    }
}
