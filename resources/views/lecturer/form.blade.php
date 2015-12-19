<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('name','Full Name') !!}
    </div>
    <div class="col-md-9">
        {!! Form::text('name', null, ['class'=> 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('email','Email (username)') !!}
    </div>
    <div class="col-md-9">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('password','Password') !!}
    </div>
    <div class="col-md-9">
        <input type="password" class="form-control" name="password" id="password">
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('retype_password','Retype Password') !!}
    </div>
    <div class="col-md-9">
        <input type="password" class="form-control" name="retype_password" id="retype_password">
    </div>
</div>

<div class="form-group">
    <div class="col-md-3">
        {!! Form::label('department_id','Department') !!}
    </div>
    <div class="col-md-9">
        {!! Form::select('department_id',$departments, null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-3">
        <p>
            <a class="btn btn-success" href="{{ action('LecturerController@index') }}">
                <i class="fa fa-users"></i>
                View all Lecturers
            </a>
        </p>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-3">
        {!! Form::submit($SubmitButtonText ,['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>
