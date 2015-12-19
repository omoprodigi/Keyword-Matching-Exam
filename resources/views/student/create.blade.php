@extends('app') 

@section('content')


<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-heading">
            <h3>Register a Student</h3>
         </div>
        @include('errors.list')
        {!! Form::open(['url' => 'student ' , 'class' => 'form-horizontal']) !!}
            @include('student.form', ['SubmitButtonText' => 'Create'])
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