@extends('app') 

@section('content')

<h1>All Departments</h1>
<hr />
@if ( !$departments->count() )
       <h2>Currently, there are no Departments.</h2>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>

                <th>
                    Department Name
                </th>
                <th>
                    Department Code
                </th>
                <th>
                    Faculty
                </th>
                <th>
                    Actions
                </th>

            </tr>
        </thead>

        <tbody>
            @foreach($departments as $dept)
            <tr>
                <td>{{ $dept->name }}</td>
                <td>{{ $dept->code }}</td>
                <td>{{ $dept->faculty_name }}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('department.show',[ $dept->id ]) }}"><i class="fa fa-book"></i> View</a>&nbsp;&nbsp;
                    <a class="btn btn-info" href="{{ route('department.edit',[ $dept->id ]) }}"><i class="fa fa-edit"></i> Edit</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<hr />
<p class="mRight"><a class="btn btn-info" href="{{ action('DepartmentController@create') }}"><i class="fa fa-plus"></i>  Create a Department</a></p>

@stop

@section('sideContent') 
    <li><a href="{{ action('CourseController@index') }}"> Courses</span></a></li>
    <li><a href="{{ action('DepartmentController@index') }}"> Departments</span></a></li>
    <li><a href="{{ action('FacultyController@index') }}"> Faculties</span></a></li>
    <li><a href="{{ action('LecturerController@index') }}"> Lecturers</span></a></li>
    <li><a href="{{ action('StudentController@index') }}"> Students</span></a></li>
@stop