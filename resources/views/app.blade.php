<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {!! Html::style('assets/css/bootstrap.min.css') !!}
    {!! Html::style('assets/css/font-awesome.min.css') !!}

    {!! Html::style('assets/css/animate.min.css') !!}
   
    {!! Html::style('assets/css/prettyPhoto.css') !!}
    {!! Html::style('assets/css/responsive.css') !!}

    <link rel="shortcut icon" href="assets/images/ico/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="assets/images/ico/apple-touch-icon-57-precomposed.png" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        h1{
            color:black;
        }

        div > label{
            width:100%;
            text-align:right;
        }

        .mRight{
            text-align:right;
        }

        .floatRight{
            float:right;
        }

        .huge {
            font-size: 40px;
            padding-top:10px;
            padding-bottom:6px;
        }

        .panel-green {
            border-color: #5cb85c;
        }
    </style>

    <title>E-Exam</title>

</head>

<body>

    <header id="header">
        <nav class="navbar navbar-default" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--{{asset('assets/images/logo.png') }}-->
                    <a href="{{ url('/welcome') }}" class="navbar-brand">
                        <img src="{{asset('assets/images/icon.jpg') }}" alt="logo" />
                    </a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li>
                            <!--class="active"-->
                            <a href="{{ action('HomeController@index') }}">Home</a>
                        </li>
                        @if (Auth::guest())
                        <li>
                            <a href="{{ action('AdminController@login') }}">Admin Login</a>
                        </li>
                        @else
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/auth/logout') }}">Logout</a>
                                </li>
                            </ul>
                        </li>

                        @endif
                    </ul>
                </div>
            </div>
            <!--/.container-->
        </nav>
        <!--/nav-->

    </header>
    <!--/header-->


    <!--<div class="container">-->
        <div class="col-md-3 col-lg-3">
            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu" style="border: none;">
                    <!--<li><a href="index.html"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>-->
                    @yield('sideContent')
                </ul>
            </div>
        </div>
        <div class="col-md-8 col-lg-8">
            @include('flash::message')
            @yield('content')
        </div>
        
    <!--</div>-->

    <br />
    <br />



    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->

    {!! Html::script('assets/js/jquery.js') !!}
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    {!! Html::script('assets/js/jquery.prettyPhoto.js') !!}
    {!! Html::script('assets/js/jquery.isotope.min.js') !!}
    {!! Html::script('assets/js/main.js') !!}
    {!! Html::script('assets/js/wow.min.js') !!}




    @yield('footer_scripts')
    <script>
        $('#flash-overlay-modal').modal();
        //$('div.alert').not('.alert-important').delay(5000).slideUp(300);
    </script>
</body>

</html>
