@extends('app')

@section('content')
<h1>Faculty Details</h1>
<hr />
<div class="col-md-12">
    <p>Course Name : {{ $course->name }}</a>&nbsp;&nbsp;</p>
</div>
<div class="col-md-12">
    <p>Course Code : {{ $course->code }}</a>&nbsp;&nbsp;</p>
</div>

<div class="col-md-12">
    <p>Exam Score (percentage) : {{ $exam->score_percentage }}</p>
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
    <li><a href="{{ action('RegistrationController@index') }}"> Course Registration</span></a></li>
@stop