<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;


use App\User;
use App\Department;
use App\Http\Requests\LecturerRequest;
use App\Http\Requests\SimpleInfoRequest;
use App\Http\Requests\SimpleLoginRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Bican\Roles\Models\Role;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Redirect;

use Laracasts\Flash\Flash;

class LecturerController extends Controller
{


    public function login()
    {
        $this->AuthorizeAndRedirect('guest');
        return view('lecturer.login');  
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

           if (!($user->hasRole('lecturer'))) {
                throw new ModelNotFoundException('Not Lecturer');
           }

           if ($user->hasRole('admin')) {
                throw new ModelNotFoundException('Not Lecturer');
           }


           if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) 
           {
                return Redirect::route('question.index');
           }

           throw new ModelNotFoundException('Not Lecturer');

        }
        catch(ModelNotFoundException $e)
        {
            $this->errorMessage = "Lecturer with specified Email and Password could not be found.";
            Flash::error($this->errorMessage);
            return Redirect::route('lecturer/login')->withInput($request->all());
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
        $lecturers = User::orderBy('name')->get();//->lists('name','id');

        for ($x = 0; $x <= count($lecturers); $x++)
        {
           if(!($lecturers[$x]->is('lecturer')))  
           {
               $lecturers->forget($x);
               continue;
           }

            if(($lecturers[$x]->is('admin')))  
           {
               $lecturers->forget($x);
           }
        }

        

        foreach ($lecturers as $lect)
        {
        	$dept =  Department::where('id','=',$lect->department_id)->firstOrFail();
            $lect['department_name'] = $dept->name;
        }


        return view('lecturer.index', compact('lecturers'));
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
        return view('lecturer.create', compact('departments'));
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

        $newLecturer =  User::where('email','=',$request['email'])->firstOrFail();

        $lecturerRole = Role::find(2);

        $newLecturer->attachRole($lecturerRole);

        Flash::success('The Lecturer has been registered.');

        return redirect()->route('lecturer.index');
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
        $lecturer =  User::findOrFail($id);

        $department =  Department::where('id','=',$lecturer->department_id)->firstOrFail();
        $lecturer['department_name'] = $department->name;

        
        return view('lecturer.show', compact('lecturer'));
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

        $lecturer = User::findOrFail($id);

        
        return view('lecturer.edit', compact('lecturer', 'departments'));
    
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
        $lecturer = User::findOrFail($id);
        $lecturer->fill($request->all())->save();
       
        Flash::success("Lecturer's details has been updated");

        return redirect('lecturer');
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
        $lecturer = User::findOrFail($id);

        $lecturer->delete();

        Flash::Success('Lecturer Deleted successfully.');

        return redirect()->route('lecturer.index');
    }
}
