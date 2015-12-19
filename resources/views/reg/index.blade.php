@extends('app') 

@section('content')

<h1>Courses Registered</h1>
<hr />
@if ( !$regs->count() )
       <h3>You have not done registration.</h3>
       <hr />
       <p class="mRight"><a class="btn btn-info" href="{{ action('RegistrationController@create') }}"><i class="fa fa-plus"></i>  Register courses</a></p>

@else
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>

                <th>
                    Course Name
                </th>
                <th>
                    Course Title
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
            @foreach($regs as $reg)
            <tr>
                <td>{{ $reg->course_name }}</td>
                <td>{{ $reg->course_code }}</td>
                <td>{{ $reg->department }}</td>
                <td>
                    @if ($reg->exam_taken) 
                        <a class="btn btn-success" href="{{ route('exam.show',[ $reg->course_id ]) }}"><i class="fa fa-book"></i> View Exam Result</a>&nbsp;&nbsp;
                    @elseif($reg->exam_ready)
                        <a class="btn btn-primary" href="{{ route('exam.take', [$reg->course_id] ) }}"><i class="fa fa-book"></i> Take Exam</a>&nbsp;&nbsp;
                    @else
                        <a class="btn btn-default" href=""> This Exam has not been prepared</a>&nbsp;&nbsp;
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@stop

@section('sideContent') 
    <li><a href="{{ action('RegistrationController@index') }}"> Course Registration</span></a></li>
@stop