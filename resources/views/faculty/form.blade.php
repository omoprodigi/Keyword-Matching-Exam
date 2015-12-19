<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('name','Faculty Name') !!}
    </div>
    <div class="col-md-9">
        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('code','Faculty Code') !!}
    </div>
    <div class="col-md-9">
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-3">
        <p>
            <a class="btn btn-success" href="{{ action('FacultyController@index') }}">
                <i class="fa fa-users"></i>
                View all Faculties
            </a>
        </p>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3">
        {!! Form::submit($SubmitButtonText ,['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>
