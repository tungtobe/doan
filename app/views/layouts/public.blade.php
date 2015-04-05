
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

         <!-- Placed at the end of the document so the pages load faster -->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
        <script src="http://malsup.github.com/jquery.form.js"></script> 
        {{ HTML::script('js/bootstrap.js'); }} 
        {{ HTML::script('js/bootstrap.min.js'); }}
        {{ HTML::script('js/jquery.runner-min.js'); }}

        
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
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              
              <a class="navbar-brand text-uppercase" href="{{URL::action('HomeController@showWelcome')}}">Tung Mobile </a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="{{URL::action('HomeController@showWelcome')}}">Home</a></li>
                    @if(Auth::check())
                        @if(Auth::user()->role == 0)
                        <li><a href="{{URL::action('AdminController@getShow')}}">Admin Manager</a></li>
                        @endif
                        <li>{{HTML::linkaction('UserController@getFavorite','Favorite',Auth::user()->id)}}</li>
                        <li><a href="{{URL::action('UserController@getBill')}}">Bill</a></li>
                        <li><a href="{{URL::action('UserController@getFriends')}}">Friends</a></li>
                    @endif
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">                    
                    @if (Auth::check())
                        <form id="socialLogin" class="navbar-form pull-right">
                            <p><span class="_hello">Hello</span> <b>{{HTML::linkAction('UserController@getShow',Auth::user()->username,array(Auth::user()->id)) }}</b>    {{ HTML::linkAction('AuthenController@getLogout','Logout', null, array('class' => '_logout')) }}  </p>
                        </form>            
                        @else
                        <li>{{ HTML::linkAction('AuthenController@getLogin','Login',array(), array('class' => 'navbar-btn _hello')) }} </li>                        
                        <li>{{ HTML::linkAction('AuthenController@getSignup','Sign Up',array(), array('class' => 'navbar-btn _hello')) }} </li>
                        @endif                    
                </ul>
            </div>
          </div>
        </nav>

     

        <!-- /container -->
        <div class="container">
            {{$content}}      
        </div> 

       

        @section('javascript') 
        @show

    </body>
</html>



