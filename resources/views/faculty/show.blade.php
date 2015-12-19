@extends('app')

@section('content')
<h1>Faculty Details</h1>
<hr />
<div class="col-md-12">
    <p>Faculty Name : {{ $faculty->name }}</a>&nbsp;&nbsp;</p>
</div>

<div class="col-md-12">
    <p>Faculty Code : {{ $faculty->code }}</p>
</div>
<div class="col-md-12">
    <div class="col-md-6"></div>

    <div class="col-md-6 mRight">
        {!! Form::open(['method' => 'DELETE','route' => ['faculty.destroy', $faculty->id] , 'class' => 'form-inline']) !!}
        {!! Form::submit('Delete Faculty', ['class' => 'btn btn-danger']) !!}
        <a class="btn btn-info" href="{{ route('faculty.edit',[ $faculty->id ]) }}">
            <i class="fa fa-edit"></i>
            Edit
        </a>
        {!! Form::close() !!}
    </div>
</div>
<hr />

<br />
<div class="col-md-12">
    <div class="col-md-6"></div>

    <div class="col-md-6 mRight">
        
    </div>
</div>


@stop


@section('sideContent') 
    <li><a href="{{ action('CourseController@index') }}"> Courses</span></a></li>
    <li><a href="{{ action('DepartmentController@index') }}"> Departments</span></a></li>
    <li><a href="{{ action('FacultyController@index') }}"> Faculties</span></a></li>
    <li><a href="{{ action('LecturerController@index') }}"> Lecturers</span></a></li>
    <li><a href="{{ action('StudentController@index') }}"> Students</span></a></li>
@stop