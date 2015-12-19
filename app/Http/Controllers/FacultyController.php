<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\FacultyRequest;

use App\Faculty;

use Laracasts\Flash\Flash;


class FacultyController extends Controller
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
        // get all the faculties
        $faculties = Faculty::all();

        // load the view and pass the staffs
        return view('faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyRequest $request)
    {
        Faculty::create($request->all());

        Flash::success('The Faculty has been created.');

        return redirect()->route('faculty.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty =  Faculty::findOrFail($id);

        return view('faculty.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty = Faculty::findOrFail($id);
        return view('faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacultyRequest $request, $id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->fill($request->all())->save();
       
        Flash::success("Faculty's details has been updated");

        return redirect('faculty');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {      
        $faculty = Faculty::findOrFail($id);

        $faculty->delete();

        Flash::Success('Faculty Deleted successfully.');

        return redirect()->route('faculty.index');
    }
}
