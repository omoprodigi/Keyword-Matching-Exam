@extends('app') 

@section('content')


<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-heading">
            <h3>Update Lecturer's Details</h3>
         </div>
        @include('errors.list')
        {!! Form::model($lecturer,['method' => 'PATCH','action' => ['LecturerController@update', $lecturer->id] ,'class' => 'form-horizontal']) !!}
            <div class="form-group">
                <div class="col-md-3">
                    {!! Form::label('name','Full Name') !!}
                </div>
                <div class="col-md-9">
                    {!! Form::text('name', null, ['class'=> 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">
                    {!! Form::label('email','Email (username)') !!}
                </div>
                <div class="col-md-9">
                    {!! Form::text('email', null, ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-3">
                    {!! Form::label('department_id','Department') !!}
                </div>
                <div class="col-md-9">
                    {!! Form::select('department_id',$departments, null, ['class' => 'form-control']) !!}
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-3">
                    <p>
                        <a class="btn btn-success" href="{{ action('LecturerController@index') }}">
                            <i class="fa fa-users"></i>
                            View all Lecturers
                        </a>
                    </p>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3">
                    {!! Form::submit("Update Details" ,['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>

        {!! Form::close() !!}
    <div>
<div>


@stop

@section('sideContent') 
    <li><a href="{{ action('CourseController@index') }}"> Courses</span></a></li>
    <li><a href="{{ action('DepartmentController@index') }}"> Departments</span></a></li>
    <li><a href="{{ action('FacultyController@index') }}"> Faculties</span></a></li>
    <li><a href="{{ action('LecturerController@index') }}"> Lecturers</span></a></li>
    <li><a href="{{ action('StudentController@index') }}"> Students</span></a></li>
@stop