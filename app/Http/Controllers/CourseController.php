<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Course;
use App\Department;
use App\User;

use Bican\Roles\Models\Role;

use App\Faculty;
use App\Http\Requests\CourseRequest;

use Exception;

use Laracasts\Flash\Flash;

class CourseController extends Controller
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
        
          $courses = Course::orderBy('name')->get();

        foreach ($courses as $course)
        {
        	$user =  User::where('id','=',$course->lecturer_id)->firstOrFail();
            $course['lecturer_name'] = $user->name;

            $dept =  Department::where('id','=',$course->department_id)->firstOrFail();
            $course['department_name'] = $dept->name;
        }


        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lecturers = User::all();//->lists('name','id');

        for ($x = 0; $x <= count($lecturers); $x++)
        {
           if(!($lecturers[$x]->is('lecturer')))  
           {
               $lecturers->forget($x);
               continue;
           } else 

           { 
                $dept = Department::where('id' ,'=' , $lecturers[$x]->department_id)->firstOrFail();
                $lecturers[$x]->name = $lecturers[$x]->name . ' (' . $dept->name . ')';
            }

            if($lecturers[$x]->is('admin'))  
           {
               $lecturers->forget($x);
           }
        }

        $lecturers = $lecturers->lists('name','id');

         return view('course.create', compact('lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $lect = User::where('id' , '=' , $request['lecturer_id'])->firstOrFail();

        $dept = Department::where('id' , '=' , $lect->department_id)->firstOrFail();

        $request['department_id'] = $dept->id;

        Course::create($request->all());

        Flash::success('The Course has been created.');

        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course =  Course::findOrFail($id);

        $lecturer =  User::where('id','=',$course->lecturer_id)->firstOrFail();
        $course['lecturer_name'] = $lecturer->name;

        
        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lecturers = User::all();//->lists('name','id');

        for ($x = 0; $x <= count($lecturers); $x++)
        {
           if(!($lecturers[$x]->is('lecturer')))  
           {
               $lecturers->forget($x);
               continue;
           } else 

           { 
                $dept = Department::where('id' ,'=' , $lecturers[$x]->department_id)->firstOrFail();
                $lecturers[$x]->name = $lecturers[$x]->name . ' (' . $dept->name . ')';
            }

            if(($lecturers[$x]->is('admin')))  
           {
               $lecturers->forget($x);
           }
        }

        $lecturers = $lecturers->lists('name','id');

        
        $course = Course::findOrFail($id);

        
        return view('course.edit', compact('course', 'lecturers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $lect = User::where('id' , '=' , $request['lecturer_id'])->firstOrFail();

        $dept = Department::where('id' , '=' , $lect->department_id)->firstOrFail();

        $request['department_id'] = $dept->id;

        $course = Course::findOrFail($id);
        $course->fill($request->all())->save();
       
        Flash::success("Course's details has been updated");

        return redirect('course');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        $course->delete();

        Flash::Success('Course Deleted successfully.');

        return redirect()->route('course.index');
    }
}
