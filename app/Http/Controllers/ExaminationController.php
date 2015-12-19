<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\Course;
use App\Department;
use App\Question;
use App\Exam;

use App\User;

use Bican\Roles\Models\Role;

use Laracasts\Flash\Flash;
use App\Http\Requests\QuestionRequest;

use Illuminate\Support\Facades\Redirect;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->AuthorizeAndRedirect('');
    }

    /**
     * Show the form for creating a new resource.
     *
     *  @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthorizeAndRedirect('');
    }


    public function take($id)
    {
        $student = Auth::user();
        $questions =  Question::where('course_id','=', $id)->get();

        if(count($questions) <= 0)
        {
            Flash::error('This Examination has not been prepared!.');

            return redirect()->route('registration.index');
        }

        $course =  Course::find($id);

        return view('exam.create', compact('questions', 'course'));
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
        $course_id = $request["course_id"];

        $questions =  Question::where('course_id','=', $course_id)->get();

        if(count($questions) <= 0)
        {
            Flash::error('There was a problem processing your request.');

            return redirect()->route('registration.index');
        }

        $question_count = 0 ;
        $passed_count = 0;

        foreach ($questions as $que)
        {
            $question_count = $question_count + 1 ;

            $keyword_found = 0;

        	$answer_array =  explode( ',', $que->answers ); 
            $students_reply_array = explode (' ', $request[$que->id]);
            $students_reply = $request[$que->id];

            foreach ($answer_array as $keyword)
            {
            	if (strpos($students_reply, $keyword) !== false) {
                    $keyword_found  = $keyword_found  + 1;
                }
            }

            if ($keyword_found == count($answer_array))
            {
                $passed_count = $passed_count + 1;
            }
            
        }

        $percent = ($passed_count / $question_count ) * 100;

        Exam::create(['course_id' => $course_id , 'student_id' => $student->id , 'score_percentage' => $percent ]);

        Flash::success('Answer sheet submitted successfully.');

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
        $student = Auth::user();

        $exam = Exam::where('course_id','=', $id)->where('student_id', $student->id)->firstOrFail();

        $course =  Course::find($id);

        return view('exam.show', compact('exam','course'));

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
