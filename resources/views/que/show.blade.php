@extends('app')

@section('content')
<h1>Examination Questions for {{ $course->name }}</h1>
<hr />
<div class="col-md-12">
    <p>Course Name : {{ $course->name }}</a>&nbsp;&nbsp;</p>
</div>

<div class="col-md-12">
    <p>Course Code : {{ $course->code }}</p>
</div>
<div class="col-md-12">
    <hr />
    @if ( !$questions->count() )
           <h2>Currently, there are no questions set.</h2>
    @else
    <div class="table-responsive col-md-12">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>

                    <th>
                        Question
                    </th>
                    <th>
                        Answer <small>(keyword)</small>
                    </th>
                    

                </tr>
            </thead>

            <tbody>
                @foreach($questions as $que)
                <tr>
                    <td>{{ $que->question }}</td>
                    <td>{{ $que->answers }}</td>
                    
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <hr />
</div>

<div class="col-md-12">
    <div class="col-md-6"></div>

    
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
    <li><a href="{{ action('QuestionController@index') }}"> Assigned Courses</span></a></li>
@stop
