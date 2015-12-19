<?php

namespace App\Http\Controllers;

use Auth;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Validatory()
    {
        if (Auth::guest()){
            return 'guest';
        } 
        else
        {
            $user =  Auth::user();
            if($user->is('admin'))
            {
                return 'admin';
            }
            elseif ($user->is('lecturer'))
            {
                return 'lecturer';
            }

            else
            {
                return 'student';
            }
        }
    
    }

    public function RedirectToHomes($roleName)
    {
        switch ( $roleName)
        {
            case 'guest':
                Redirect::to('home')->send();
                break;
            case 'admin':
                Redirect::to('lecturer')->send();
                break;
            case 'lecturer':
                Redirect::to('question')->send();
                break;
            case 'student':
                Redirect::to('registration')->send();
                break;
            default :
                Redirect::to('home')->send();
                break;
        }        
    }

    public function AuthorizeAndRedirect($roleName)
    {        
        if ($this->Validatory() != $roleName)
        {
            $this->RedirectToHomes($this->Validatory());
        }    
    }

}
