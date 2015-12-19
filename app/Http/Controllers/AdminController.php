<?php

namespace App\Http\Controllers;
use Auth;

use App\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SimpleLoginRequest;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends Controller
{

    private $errorMessage = 'No errors';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->AuthorizeAndRedirect('');
    }

    public function login()
    {
        $this->AuthorizeAndRedirect('guest');
        return view('admin.login');     
    }


    /**
     * Authenticate an administrator
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

           if (!($user->hasRole('admin'))) {
                throw new ModelNotFoundException('Not Admin');
           }


           if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) 
           {
                return Redirect::route('lecturer.index');
           }

           throw new ModelNotFoundException('Not Admin');

        }
        catch(ModelNotFoundException $e)
        {
            $this->errorMessage = "Administrator with specified Email and Password could not be found.";
            Flash::error($this->errorMessage);
            return Redirect::route('admin/login')->withInput($request->all());
        }  
    }

    public function dashboard()
    {
        $this->AuthorizeAndRedirect('');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->AuthorizeAndRedirect('');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->AuthorizeAndRedirect('');
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
