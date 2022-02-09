<?php

namespace App\Http\Controllers\Admin;

use App\Departments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Departments::orderBy('id', 'desc')->paginate(15);
        return view('admin.departments.index', compact('departments'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Departments::create($request->all());
        return redirect()->back()->withMessage('Department added successfully');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $department = Departments::find($id);
        $output = ' 
                    <label class="control-label">Department Name:</label>
                    <input type="text" class="form-control" name="name" value="'.$department->name.'" required/>
                    <input type="hidden" name="id" value="'.$department->id.'"/>';
         return  $output;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $department = Departments::find($request->id);
        $department->name = $request->name;
        $department->save();
        return redirect()->back()->withMessage('Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      Departments::find($id)->delete();
        return 'success';
    }
}
