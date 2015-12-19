@extends('app')



@section('content')

<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-heading">
            <h3>{{ $course->name }} Examination</h3>
            <hr/>
         </div>
        @include('errors.list')
        {!! Form::open(['url' => 'exam ' , 'class' => 'form-horizontal']) !!}

           @foreach($questions as $que)
            <div class="form-group">
                <div class="col-md-12">
                    {!! Form::label($que->id, '> ' . $que->question, ['style' => 'text-align:left']) !!}
                </div>
                <div class="col-md-12">
                    {!! Form::textarea($que->id, null, ['class'=> 'form-control', 'rows' => '5']) !!}
                </div>
            </div>
            <hr/> 
           @endforeach

           <input name="course_id" type="text" value="{{ $course->id }}" hidden="hidden" />

           <div class="form-group">
                <div class="col-md-3">
                   
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3">
                    {!! Form::submit("Submit" ,['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>

        {!! Form::close() !!}
    <div>
<div>




@stop

