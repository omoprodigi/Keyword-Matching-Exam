<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('name','Course Name') !!}
    </div>
    <div class="col-md-9">
        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('code','Course Code') !!}
    </div>
    <div class="col-md-9">
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('lecturer_id','Lecturer in Charge') !!}
    </div>
    <div class="col-md-9">
        {!! Form::select('lecturer_id',$lecturers, null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-3">
        <p>
            <a class="btn btn-success" href="{{ action('CourseController@index') }}">
                <i class="fa fa-users"></i>
                View all Courses
            </a>
        </p>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3">
        {!! Form::submit($SubmitButtonText ,['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>
