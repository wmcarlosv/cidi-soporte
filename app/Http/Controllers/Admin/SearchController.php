<?php

namespace App\Http\Controllers\Admin;

use App\Departments;
use App\Tickets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request){
        $tickets = Tickets::where('subject', 'like', '%' .$request->q . '%')->paginate(15);
        $search_term = $request->q;

        $open = Tickets::where('status', 'open')->count();
        $replied = Tickets::where('status', 'replied')->count();
        $closed = Tickets::where('status', 'closed')->count();
        $pending = Tickets::where('status', 'pending')->count();

        $departments = Departments::all();
        $tickets_depart = Tickets::all();

         return view('admin.tickets.index', compact('tickets', 'search_term', 'open','replied', 'closed', 'pending', 'departments', 'tickets_depart'));
    }


    public function status($status){
        $tickets = Tickets::where('status', $status)->paginate(15);
        $open = Tickets::where('status', 'open')->count();
        $replied = Tickets::where('status', 'replied')->count();
        $closed = Tickets::where('status', 'closed')->count();
        $pending = Tickets::where('status', 'pending')->count();

        $departments = Departments::all();
        $tickets_depart = Tickets::all();

        return view('admin.tickets.index', compact('tickets', 'open','replied', 'closed', 'pending', 'departments', 'tickets_depart'));

    }


    public function department($id){

        $tickets = Tickets::where('department_id', $id)->paginate(15);

        $open = Tickets::where('status', 'open')->count();
        $replied = Tickets::where('status', 'replied')->count();
        $closed = Tickets::where('status', 'closed')->count();
        $pending = Tickets::where('status', 'pending')->count();

        $departments = Departments::all();
        $tickets_depart = Tickets::all();

        return view('admin.tickets.index', compact('tickets', 'open','replied', 'closed', 'pending', 'departments', 'tickets_depart'));

    }

}
