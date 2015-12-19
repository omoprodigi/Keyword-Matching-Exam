@extends('app')

@section('content')
<h1>Student's Details</h1>
<hr />
<div class="col-md-12">
    <p>Full Name : {{ $student->name }}</a>&nbsp;&nbsp;</p>
</div>

<div class="col-md-12">
    <p>Email : {{ $student->email }}</p>
</div>
<div class="col-md-12">
    <p>Department : {{ $student->department_name }}</p>
</div>
<div class="col-md-12">
    <div class="col-md-6"></div>

    <div class="col-md-6 mRight">
        {!! Form::open(['method' => 'DELETE','route' => ['student.destroy', $student->id] , 'class' => 'form-inline']) !!}
        {!! Form::submit('Delete Student', ['class' => 'btn btn-danger']) !!}
        <a class="btn btn-info" href="{{ route('student.edit',[ $student->id ]) }}">
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
