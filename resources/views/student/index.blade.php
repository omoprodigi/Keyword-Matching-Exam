@extends('app') 

@section('content')

<h1>All Students</h1>
<hr />
@if ( !$students->count() )
       <h2>Currently, there are no Lecturers.</h2>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>

                <th>
                    Students's Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    Department
                </th>
                <th>
                    Actions
                </th>

            </tr>
        </thead>

        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->department_name }}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('student.show',[ $student->id ]) }}"><i class="fa fa-book"></i> View</a>&nbsp;&nbsp;
                    <a class="btn btn-info" href="{{ route('student.edit',[ $student->id ]) }}"><i class="fa fa-edit"></i> Edit</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<hr />
<p class="mRight"><a class="btn btn-info" href="{{ action('StudentController@create') }}"><i class="fa fa-plus"></i>  Register a Student</a></p>

@stop

@section('sideContent') 
    <li><a href="{{ action('CourseController@index') }}"> Courses</span></a></li>
    <li><a href="{{ action('DepartmentController@index') }}"> Departments</span></a></li>
    <li><a href="{{ action('FacultyController@index') }}"> Faculties</span></a></li>
    <li><a href="{{ action('LecturerController@index') }}"> Lecturers</span></a></li>
    <li><a href="{{ action('StudentController@index') }}"> Students</span></a></li>
@stop