<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Course;
use App\Department;
use App\Question;

use App\User;

use Bican\Roles\Models\Role;

use Laracasts\Flash\Flash;
use App\Http\Requests\QuestionRequest;

use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->AuthorizeAndRedirect('lecturer');
    }


    public function index()
    {
        $user =  Auth::user();
        $courses = Course::where('lecturer_id','=',$user->id)->get();
        
        foreach ($courses as $course)
        {
        	$dept =  Department::where('id','=',$course->department_id)->firstOrFail();
            $course['department_name'] = $dept->name;

            $questions = Question::where('course_id', '=' , $course->id)->get();
            if(count($questions) > 0)
            {
                $course->questions_set = true;
            }

            else
            {
                $course->questions_set = false;
            }
        }



        return view('que.index', compact('courses'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user =  Auth::user();
        $courses = Course::where('lecturer_id','=',$user->id)->get()->lists('name','id');


        return view('que.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $qanda = json_decode(stripslashes($request["questions_and_answers"]));
        
        $course_id = $request["course_id"];

        $questions = Question::where('course_id','=',$course_id)->get();

        if(count($questions))
        {
            Flash::error('Question(s) have already been set.');

            return redirect()->route('question.create');
        }


        for ($i = 0 ; $i < count($qanda) ; $i++)
        {
            Question::create(['course_id' => $course_id , 'question' => $qanda[$i]->Question , 'answers' => $qanda[$i]->Answers ]);
        }

        
        Flash::success('The Question(s) have been set.');

        return redirect()->route('question.index');
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

        $questions =  Question::where('course_id','=',$course->id)->get();


        
        return view('que.show', compact('course', 'questions'));
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
