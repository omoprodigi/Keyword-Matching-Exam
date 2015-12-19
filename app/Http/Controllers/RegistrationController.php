<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

use App\Course;
use App\Department;
use App\Question;
use App\Registration;
use App\Exam;
use App\User;

use Laracasts\Flash\Flash;



use Bican\Roles\Models\Role;

class RegistrationController extends Controller
{

    public function __construct(){
        $this->AuthorizeAndRedirect('student');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Auth::user();
        $regs =  Registration::where('student_id','=', $student->id)->get();

        foreach ($regs as $reg)
        {
            $course  = Course::where('id', '=' , $reg->course_id)->firstOrFail();
            $reg["course_name"] = $course->name;
            $reg["course_code"] = $course->code;

            $dept = Department::find($course->department_id);
            $reg["department"] = $dept->name;

            $reg["exam_taken"] = false;
            
            if((Exam::where('student_id', $student->id)->where('course_id', $course->id)->count()) > 0)
            {
                $reg["exam_taken"] = true;
            }

            $reg["exam_ready"] = false;
           
            if((Question::where('course_id', $reg->course_id)->count()) >  0)
            {
                $reg["exam_ready"] = true;
            }

        }

        return view('reg.index', compact('regs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = Auth::user();
        $regs =  Registration::where('student_id','=', $student->id)->get();

        if(count($regs) > 0)
        {
            Flash::error('You have completed registration!.');

            return redirect()->route('registration.index');
        }

        $courses =  Course::orderBy('name')->lists('name','id');
        return view('reg.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = Auth::user();
        $regs =  Registration::where('student_id','=', $student->id)->get();

        if(count($regs) > 0)
        {
            Flash::error('You have completed registration!.');

            return redirect()->route('registration');
        }

        $courses = (json_decode(stripslashes($request["courses_selected"])));
        $courses_unique = array_unique($courses);

        foreach ($courses_unique as $course)
        {
        	Registration::create(['course_id' => $course , 'student_id' => $student->id ]);
        }

        Flash::success('Registration complete.');

        return redirect()->route('registration.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->AuthorizeAndRedirect('');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->AuthorizeAndRedirect('');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->AuthorizeAndRedirect('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->AuthorizeAndRedirect('');
    }
}
