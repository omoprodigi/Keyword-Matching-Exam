@extends('app') 

@section('content')

   
   
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="panel-heading"><h3>Administrator Login</h3></div>
                    @include('errors.list')
                    {!! Form::open(['url' => 'admin/auth' , 'class' => 'form-horizontal']) !!}
                        
                         {!! csrf_field() !!}

                       <div class="form-group">
                            <div class="col-md-3">
                                {!! Form::label('username','Username') !!}
                            </div>
                            <div class="col-md-9">
                                {!! Form::text('username',null, ['class' => 'form-control' , 'placeholder' => 'username']) !!}
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
							<div class="col-md-6">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

                        <div class="form-group">
                            <div class="col-md-3">
       
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                {!! Form::submit('Login' ,['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        </div>

						

                    {!! Form::close() !!}
                </div>
            </div> 
        </div>
    </div>
   
	    



@stop


@section('sideContent')

  <li><a href="{{ action('HomeController@index') }}"> Home</span></a></li>
@stop