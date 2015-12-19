<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LecturerRequest;
use App\Http\Requests\SimpleInfoRequest;
use App\Http\Requests\SimpleLoginRequest;

use App\User;
use App\Department;

use Bican\Roles\Models\Role;


use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Redirect;

use Laracasts\Flash\Flash;

class StudentController extends Controller
{


    public function login()
    {
        $this->AuthorizeAndRedirect('guest');
        return view('student.login');  
    }

    /**
     * Authenticate a Lecturer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(SimpleLoginRequest $request)
    {
        $this->AuthorizeAndRedirect('guest');
        $email = $request->input("username");
        $password = $request->input("password");
        $remember = $request->input("remember");

        try
        {
           $user = User::where('email', '=', $email)->firstOrFail();

           if (!($user->hasRole('student'))) {
                throw new ModelNotFoundException('Not Student');
           }

           if ($user->hasRole('admin')) {
                throw new ModelNotFoundException('Not Student');
           }

           if ($user->hasRole('lecturer')) {
                throw new ModelNotFoundException('Not Student');
           }


           if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) 
           {
                return Redirect::route('question.index');
           }

           throw new ModelNotFoundException('Not Student');

        }
        catch(ModelNotFoundException $e)
        {
            $this->errorMessage = "Student with specified Email and Password could not be found.";
            Flash::error($this->errorMessage);
            return Redirect::route('student/login')->withInput($request->all());
        }  
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->AuthorizeAndRedirect('admin');
        $students = User::orderBy('name')->get();//->lists('name','id');

        for ($x = 0; $x <= count($students); $x++)
        {
           if(!($students[$x]->is('student')))  
           {
               $students->forget($x);
               continue;
           }

            if(($students[$x]->is('admin')) || ($students[$x]->is('lecturer')))  
           {
               $students->forget($x);
           }
        }

        

        foreach ($students as $student)
        {
        	$dept =  Department::where('id','=',$student->department_id)->firstOrFail();
            $student['department_name'] = $dept->name;
        }


        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthorizeAndRedirect('admin');
        $departments = Department::orderBy('name')->lists('name','id');
         return view('student.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LecturerRequest $request)
    {
        $this->AuthorizeAndRedirect('admin');
        $request['password'] = bcrypt($request['password']);

        User::create($request->all());

        $newStudent =  User::where('email','=',$request['email'])->firstOrFail();

        $studentRole = Role::find(3);

        $newStudent->attachRole($studentRole);

        Flash::success('The Student has been registered.');

        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->AuthorizeAndRedirect('admin');
         $student =  User::findOrFail($id);

        $department =  Department::where('id','=',$student->department_id)->firstOrFail();
        $student['department_name'] = $department->name;

        
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->AuthorizeAndRedirect('admin');
        $departments = Department::orderBy('name')->lists('name','id');

        $student = User::findOrFail($id);
    
        return view('student.edit', compact('student', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SimpleInfoRequest $request, $id)
    {
        $this->AuthorizeAndRedirect('admin');
         $student = User::findOrFail($id);
        $student->fill($request->all())->save();
       
        Flash::success("Student's details has been updated");

        return redirect('student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->AuthorizeAndRedirect('admin');
        $student = User::findOrFail($id);

        $student->delete();

        Flash::Success('Student Deleted successfully.');

        return redirect()->route('student.index');
    }
}
