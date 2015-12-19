@extends('app')

@section('sideContent') 
    <li><a href="{{ action('QuestionController@index') }}"> Assigned Courses</span></a></li>
@stop

@section('content')


<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-heading">
            <h3>Set Examination Questions</h3>
         </div>
        @include('errors.list')
        {!! Form::open(['url' => 'question ' , 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                <div class="col-md-3">
                    {!! Form::label('course_id','Course') !!}
                </div>
                <div class="col-md-9">
                    {!! Form::select('course_id',$courses, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div id="dynamicInput" class="col-md-11 col-md-offset-1">
                  <hr/>
                  <p style="text-align:left"><small>Question 1</small></p>
                  <div class="qadiv">
                      <div class="form-group">
                            <div class="col-md-3">
                                {!! Form::label(null,'Question') !!}
                            </div>
                            <div class="col-md-9">
                                {!! Form::textarea('null', null, ['class' => 'form-control' , 'rows' => '5']) !!}
                            </div>
                       </div>
                       <div class="form-group">
                            <div class="col-md-3">
                                {!! Form::label(null,'Answers') !!}
                            </div>
                            <div class="col-md-9">
                                <p style="text-align:left"><small>Please seperate each keyword with a comma</small></p>
                                {!! Form::text('null', null, ['class' => 'form-control answer']) !!}
                            </div>
                       </div>
                   </div>
                   <hr/>

            </div>
            <p style="text-align:right;"><input type="button" value="Add another question" onClick="addInput('dynamicInput');"></p>  
            <hr/>
            <div class="form-group">
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3">
                    <input type="hidden" name="questions_and_answers" id="questions_and_answers" />
                    <input class="btn btn-primary form-control" id="FormButton" type="submit" value="Set Questions">
                </div>
            </div>


        {!! Form::close() !!}
    <div>
<div>


@stop

@section('footer_scripts')

    <script>
        var globalArr = [];

        function qAnda(question, answers) {
            this.Question = question;
            this.Answers = answers;
        }

        var counter = 1;
        var limit = 40;
        function addInput(divName){
             if (counter == limit)  {
                  alert("You have reached the limit of adding " + counter + " inputs");
             }
             else {
                  var topdiv = document.createElement('div');
                  topdiv.className = 'form-group';

                  topdiv.innerHTML = '<div class="col-md-3"><label>Question</label></div><div class="col-md-9"><textarea class="form-control" rows="5"></textarea></div>';
                  
                   var bottomdiv = document.createElement('div');
                  bottomdiv.className = 'form-group';

                  bottomdiv.innerHTML = '<div class="col-md-3"><label>Answers</label></div><div class="col-md-9"><p style="text-align:left"><small>Please seperate each keyword with a comma</small></p><input type="text" class="form-control answer" /></div><hr>';
                      

                  var newdiv = document.createElement('div');
                  newdiv.className = 'qadiv';
                  newdiv.innerHTML = ' <p style="text-align:left"><small>Question ' + (counter + 1) + '</small></p>';

                  newdiv.appendChild(topdiv);

                  newdiv.appendChild(bottomdiv);


                  //newdiv.innerHTML = newdiv.innerHTML + '</div><div class="form-group"><div class="col-md-3">';
                  //newdiv.innerHTML = newdiv.innerHTML +  '<label>Answers (Please seperate each keyword with a comma)</label></div><div class="col-md-9">';
                  //newdiv.innerHTML = newdiv.innerHTML + '<input type="text" class="form-control" /></div></div><hr/>';// "Entry " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";
                 
                  document.getElementById(divName).appendChild(newdiv);
                  counter++;
             }
             
        }

        
        $("#FormButton").click(function () {
            var _this = $(this);
            var _form = _this.closest("form");

            
           var qadivs = _form.find( "div.qadiv" );
           
          

           globalArr = [];
            

           for ( i = 0 ; i < qadivs.length ; i++) {
                var div = document.createElement("div");
                div.innerHTML = qadivs[i];
                var tarea = $(qadivs[i]).find("textarea");
                var text = $(qadivs[i]).find("input.answer");

                var question = $(tarea).val();
                var answer = $(text).val();


                if(question.trim() == '' || answer.trim() == '')
                {
                    alert('Incomplete Questions and/or Answers');
                    return false;
                }

                 var item = new qAnda(question, answer);
                 globalArr.push(item);
                
                
            }
            
            $("#questions_and_answers").val(JSON.stringify(globalArr));
            console.log(JSON.stringify(globalArr));
            _form.submit();

            return true;
        });

    </script>

@stop