<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Department;
use App\Faculty;
use App\Http\Requests\DepartmentRequest;

use Exception;

use Laracasts\Flash\Flash;

class DepartmentController extends Controller
{

    public function __construct(){
        $this->AuthorizeAndRedirect('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //::orderBy('orderByColumn')->
          $departments = Department::orderBy('name')->get();

        foreach ($departments as $dept)
        {
        	$fac =  Faculty::where('id','=',$dept->faculty_id)->firstOrFail();
            $dept['faculty_name'] = $fac->name;
        }


        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $faculties = Faculty::orderBy('name')->lists('name','id');
         return view('department.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        try {
            Department::create($request->all());

            Flash::success('The Department has been created.');

            return redirect()->route('department.index');
        } 
        catch (Exception $e)
        {
           Flash::error('The Department could not be created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department =  Department::findOrFail($id);

        $faculty =  Faculty::where('id','=',$department->faculty_id)->firstOrFail();
        $department['faculty_name'] = $faculty->name;

        
        return view('department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $faculties = Faculty::orderBy('name')->lists('name','id');

        $department = Department::findOrFail($id);

        
        return view('department.edit', compact('department', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->fill($request->all())->save();
       
        Flash::success("Department's details has been updated");

        return redirect('department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);

        $department->delete();

        Flash::Success('Department Deleted successfully.');

        return redirect()->route('department.index');
    }
}
