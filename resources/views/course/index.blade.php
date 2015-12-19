@extends('app') 

@section('content')

<h1>All Courses</h1>
<hr />
@if ( !$courses->count() )
       <h2>Currently, there are no Courses.</h2>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>

                <th>
                    Course Name
                </th>
                <th>
                    Course Code
                </th>
                <th>
                    Lecturer-In-Charge
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
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->code }}</td>
                <td>{{ $course->lecturer_name }}</td>
                <td>{{ $course->department_name }}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('course.show',[ $course->id ]) }}"><i class="fa fa-book"></i> View</a>&nbsp;&nbsp;
                    <a class="btn btn-info" href="{{ route('course.edit',[ $course->id ]) }}"><i class="fa fa-edit"></i> Edit</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<hr />
<p class="mRight"><a class="btn btn-info" href="{{ action('CourseController@create') }}"><i class="fa fa-plus"></i>  Create a Course</a></p>

@stop

@section('sideContent') 
    <li><a href="{{ action('CourseController@index') }}"> Courses</span></a></li>
    <li><a href="{{ action('DepartmentController@index') }}"> Departments</span></a></li>
    <li><a href="{{ action('FacultyController@index') }}"> Faculties</span></a></li>
    <li><a href="{{ action('LecturerController@index') }}"> Lecturers</span></a></li>
    <li><a href="{{ action('StudentController@index') }}"> Students</span></a></li>
@stop