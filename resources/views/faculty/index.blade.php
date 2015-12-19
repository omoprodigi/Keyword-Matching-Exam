@extends('app') 

@section('content')

<h1>All Faculties</h1>
<hr />
@if ( !$faculties->count() )
       <h2>Currently, there are no Faculties.</h2>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>

                <th>
                    Faculty Name
                </th>
                <th>
                    Faculty Code
                </th>
                <th>
                    Actions
                </th>

            </tr>
        </thead>

        <tbody>
            @foreach($faculties as $faculty)
            <tr>
                <td>{{ $faculty->name }}</td>
                <td>{{ $faculty->code }}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('faculty.show',[ $faculty->id ]) }}"><i class="fa fa-book"></i> View</a>&nbsp;&nbsp;
                    <a class="btn btn-info" href="{{ route('faculty.edit',[ $faculty->id ]) }}"><i class="fa fa-edit"></i> Edit</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<hr />
<p class="mRight"><a class="btn btn-info" href="{{ action('FacultyController@create') }}"><i class="fa fa-plus"></i>  Create a Faculty</a></p>

@stop

@section('sideContent') 
    <li><a href="{{ action('CourseController@index') }}"> Courses</span></a></li>
    <li><a href="{{ action('DepartmentController@index') }}"> Departments</span></a></li>
    <li><a href="{{ action('FacultyController@index') }}"> Faculties</span></a></li>
    <li><a href="{{ action('LecturerController@index') }}"> Lecturers</span></a></li>
    <li><a href="{{ action('StudentController@index') }}"> Students</span></a></li>
@stop