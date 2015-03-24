
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Tung Mobile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        {{ HTML::style('css/bootstrap.min.css'); }}
        {{ HTML::style('css/bootstrap-responsive.css'); }}
        {{ HTML::style('css/css.css'); }}
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>


        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../assets/ico/favicon.png">
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="brand" href="{{URL::action('HomeController@showWelcome')}}">Tung Mobile</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active"><a href="{{URL::action('HomeController@showWelcome')}}">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Nav header</li>
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                        </ul>
                        @if (Auth::check())
                        <form id="socialLogin" class="navbar-form pull-right">
                            <p><span class="_hello">Hello</span> <b>{{HTML::linkAction('UserController@getShow',Auth::user()->username,array(Auth::user()->id)) }}</b>    {{ HTML::linkAction('AuthenController@getLogout','Logout', null, array('class' => '_logout')) }}  </p>
                        </form>            
                        @else
                        <form id="socialLogin" class="navbar-form pull-right">
                            <p><span class="_hello">{{ HTML::linkAction('AuthenController@getLogin','Login') }}  </span> or <span class="_hello">{{ HTML::linkAction('AuthenController@getSignup','Sign Up') }}</span> </p>
                        </form>
                        @endif

                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <!-- /container -->
        <div class="container">
            {{$content}}      
        </div> 

        <!-- Placed at the end of the document so the pages load faster -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>  
        <script src="http://malsup.github.com/jquery.form.js"></script> 
        {{ HTML::script('js/bootstrap.js'); }} 
        {{ HTML::script('js/jquery-2.1.1.js'); }} 
        {{ HTML::script('js/bootstrap.min.js'); }}
        {{ HTML::script('js/jquery.runner-min.js'); }}

        @section('javascript') 
        @show

    </body>
</html>

