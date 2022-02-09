<?php

namespace App\Http\Controllers;

use App\Tickets;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $tickets = Tickets::all();
        return view("admin.index", compact('tickets'));
    }
    
    public function search(Request $request){
        $comments = Comments::orderBy('id', 'desc')->take(5)->get();
        if($request->date == null & $request->status == null & $request->user == null){
            return redirect::to("/admin");
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
            } elseif ($request->date == 'Last 7 Days') {
                $date = Carbon::now()->subWeeks(1)->toDateString();
            } elseif ($request->date == 'month') {
                $date = Carbon::now()->subMonth(1)->toDateString();
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
            elseif ($request->date == 'Last 7 Days') {
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
            return  view("admin.index", compact('complaints','comments', 'directors', 'assigned_user','status', 'selection_date'));
        }
    }

    public function getDirectors(Request $request){
        $range = explode( ' - ', $request->range );
       $directors = User::where('role_id', 3)->get();
       $complaints = Complaints::whereDate('created_at','>=', date($range[0]))->whereDate('created_at','<=', date($range[1]))->get();
        return  view("admin.director", compact('directors', 'complaints'));
    }

}
