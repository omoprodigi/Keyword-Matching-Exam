@extends('app') 

@section('content')

    
	    <div class="row">
            <div class="col-md-4">
                 <div class="panel panel-info">
                    <a href="{{ action('AdminController@login') }}">
                   
                            <div class="panel-body">
                                <h3 style="text-align: center;">Admin</h3>
                            </div>
                        
                    </a> 
                  </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-primary">
                    <a href="{{ action('LecturerController@login') }}">
                       
                            <div class="panel-body">
                                <h3 style="text-align: center;">Lecturers</h3>
                            </div>
                       
                    <a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-info">
                    <a href="{{ action('StudentController@login') }}">

                    <div class="panel-body">
                        <h3 style="text-align: center;">Students</h3>
                    </div> 

                    <a>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel panel-success">
                    <div class="panel-body">
                        <h3 style="text-align: center;">About Us</h3>
                    </div> 
            </div>
        </div>


@stop


@section('sideContent')

  <li><a href="{{ action('HomeController@index') }}"> Home</span></a></li>
@stop