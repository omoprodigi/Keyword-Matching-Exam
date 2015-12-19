@extends('app')

@section('sideContent') 
    <li><a href="{{ action('RegistrationController@index') }}"> Course Registration</span></a></li>
@stop

@section('content')


<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-heading">
            <h3>Register Courses</h3>
         </div>
        @include('errors.list')
        {!! Form::open(['url' => 'registration ' , 'class' => 'form-horizontal']) !!}
           
            <div id="dynamicInput" class="col-md-11 col-md-offset-1">
                  <hr/>
                  <div class="qadiv">
                      <div class="form-group">
                            <div class="col-md-6">
                                <p style="text-align:left"><small>Course 1</small></p>
                            </div>
                            <div class="col-md-6">
                                {!! Form::select('null',$courses, null, ['class' => 'form-control course_select']) !!}
                            </div>
                       </div>
                       
                  </div>
                  <hr/>

            </div>
            <p style="text-align:right;"><input type="button" value="Add another course" onClick="addInput('dynamicInput');"></p>  
            <hr/>
            <div class="form-group">
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3">
                    <input type="hidden" name="courses_selected" id="courses_selected" />
                    <input class="btn btn-primary form-control" id="FormButton" type="submit" value="Register">
                </div>
            </div>


        {!! Form::close() !!}
    <div>
<div>


@stop

@section('footer_scripts')

    <script>
        var globalArr = <?php echo json_encode($courses); ?>;;

        function qAnda(question, answers) {
            this.Question = question;
            this.Answers = answers;
        }

        var counter = 1;
        var limit = 15;
        function addInput(divName){
             if (counter == limit)  {
                  alert("You have reached the limit of adding " + counter + " courses");
             }
             else 
                {
                  var OuterDiv = document.createElement('div');
                  OuterDiv.className = 'form-group';

                  OuterDiv.innerHTML = '<div class="col-md-6"><p style="text-align:left"><small>Course ' + ( counter + 1 ) + '</small></p></div>';

                  var innerDiv = document.createElement('div');
                  innerDiv.className = 'col-md-6';


                  var selectList = document.createElement("select");
                    selectList.className = "form-control course_select";
                   
                    for(key in globalArr)
                    {
                        var option = document.createElement("option");
                        option.value = key;
                        option.text = globalArr[key];
                        selectList.appendChild(option);
                    }

                    

                      innerDiv.appendChild(selectList);                  
                     

                  var newdiv = document.createElement('div');
                  newdiv.className = 'qadiv';
                 // newdiv.innerHTML = ' <p style="text-align:left"><small>Question ' + (counter + 1) + '</small></p>';

                  OuterDiv.appendChild(innerDiv);

                  

                  newdiv.appendChild(OuterDiv);

                  newdiv.appendChild(document.createElement('hr'));


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
           
          
           selectedArr = [];
          
            

           for ( i = 0 ; i < qadivs.length ; i++) {
                var tarea = $(qadivs[i]).find("textarea");
                var text = $(qadivs[i]).find("input.answer");

                var select =  $(qadivs[i]).find("select");

                //console.log(select.find(":selected").text());
                var course_id = select.find(":selected").val();
                
                
                if(course_id.trim() == '')
                {
                    alert('One or more courses not selected');
                    return false;
                }

                
                 selectedArr.push(course_id);
                
            }
            
            $("#courses_selected").val(JSON.stringify(selectedArr));
            console.log(JSON.stringify(selectedArr));
            _form.submit();

            return false;
        });

    </script>

@stop