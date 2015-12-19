@extends('app') 

@section('content')

<h1>Assigned Courses</h1>
<hr />
@if ( !$courses->count() )
       <h2>Currently, there are no courses assigned to you.</h2>
@else
<div class="table-responsive col-md-12">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>

                <th>
                    Course Title
                </th>
                <th>
                    Course Code
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
                <td>{{ $course->department_name }}</td>
                <td>
                    @if ($course->questions_set) 
                    
                        <a class="btn btn-info" href="{{ route('question.show',[ $course->id ]) }}"><i class="fa fa-book"></i> View Questions</a>
                    
                    @else
                    
                        <a class="btn btn-primary" href="{{ route('question.create') }}"><i class="fa fa-edit"></i> Set Questions</a>&nbsp;&nbsp;
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<hr />


@stop

@section('sideContent') 
    <li><a href="{{ action('QuestionController@index') }}"> Assigned Courses</span></a></li>
@stop
