<?php

namespace App\Http\Controllers\Admin;

use App\Departments;
use App\Faq;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $faqs = Faq::orderBy('id', 'desc')->Paginate(15);
        return view('admin.faq.index', compact('faqs'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments =  Departments::all();
       return view('admin.faq.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'department' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ]);
        $faq = new Faq();
        $faq->subject = $request->subject;
        $faq->department_id = $request->department;
        $faq->description = $request->description;
        $faq->save();

        return redirect::to('admin/faq');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $departments =  Departments::all();
        $faq = Faq::find($id);
        return view('admin.faq.edit', compact('faq', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'department' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ]);
        $faq = Faq::find($id);
        $faq->subject = $request->subject;
        $faq->department_id = $request->department;
        $faq->description = $request->description;
        $faq->save();
        return redirect()->back()->withMessage('Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Faq::find($id)->delete();
        return 'success';
    }
}
