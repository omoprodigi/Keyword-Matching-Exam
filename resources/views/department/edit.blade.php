@extends('app') 

@section('content')


<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-heading">
            <h3>Update Department Details</h3>
         </div>
        @include('errors.list')
        {!! Form::model($department,['method' => 'PATCH','action' => ['DepartmentController@update', $department->id] ,'class' => 'form-horizontal']) !!}
            @include('department.form', ['SubmitButtonText' => 'Update Details'])
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