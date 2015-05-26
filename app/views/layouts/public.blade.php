
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
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        {{ HTML::script('js/jquery-1.9.1.js'); }}
        {{ HTML::script('js/jquery.min.js'); }} 
        {{ HTML::script('js/jquery.form.js'); }} 
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
                    <a class="navbar-brand text-uppercase" href="{{URL::action('HomeController@showWelcome')}}"><b>Tung Mobile</b></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="nav navbar-nav navbar-left">
                        <li class="active"><a href="{{URL::action('HomeController@showWelcome')}}">Home</a></li>
                        @if(Auth::check())
                            @if(Auth::user()->role == 0)
                            <li>{{HTML::linkAction('AdminController@showItem','Admin Manager')}}</li>
                            @endif
                            <li>{{HTML::linkaction('UserController@getFavorite','Favorite',Auth::user()->id)}}</li>
                            <li>{{HTML::linkaction('UserController@getBill','Order',Auth::user()->id)}}</li>
                        @endif
                        <li>{{HTML::linkAction('HomeController@advanceSearch','Advance Search')}}</li>
                    </ul>

                    <ul class="nav navbar-right _nav">
                        <li>
                            {{ Form::open(array('action' => 'HomeController@search', 'method' => 'get', 'class' => 'navbar-form navbar-right')) }}
                                <div class="box">
                                    <div class="form-group">
                                        <input type="search" class="form-control" name="search" id="search" placeholder="Search..." />
                                    </div>
                                    <button type="submit" id="submit" class="_hide"><i class="fa fa-search"></i></button>
                                </div>
                            {{ Form::close() }}
                        </li>


                        <li>
                            @if (Auth::check())
                            <form id="socialLogin" class="navbar-form navbar-right">
                                <p><span class="_hello">Hello</span> <b>{{HTML::linkAction('UserController@getShow',Auth::user()->username,array(Auth::user()->id)) }}</b>    {{ HTML::linkAction('AuthenController@getLogout','Logout', null, array('class' => '_logout')) }}  </p>
                            </form>            
                            @else
                            <li>{{ HTML::linkAction('AuthenController@getLogin','Login',array(), array('class' => 'navbar-btn _hello navbar-right _nav')) }} </li>
                            <li>{{ HTML::linkAction('AuthenController@getSignup','Sign Up',array(), array('class' => 'navbar-btn _hello navbar-right _nav')) }} </li>
                            @endif     
                        </li>  
                    </ul>

                </div>
            </div>
        </nav>

     

        <!-- /container -->
        <div class="container-fluid _container_1">
            {{$content}}      
        </div> 

       
        <script type="text/javascript">
        $(function() {
            $('#search').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    $('#submit').click();
                }
            });
        })
        </script>
        @section('javascript') 
        @show

    </body>
</html>



