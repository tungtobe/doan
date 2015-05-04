
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Admin Manage</title>
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
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              
              <a class="navbar-brand text-uppercase" href="{{URL::action('HomeController@showWelcome')}}">Tung Mobile </a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="nav navbar-nav navbar-left">
                    <li class=""><a href="{{URL::action('HomeController@showWelcome')}}">Home</a></li>
                    @if(Auth::check())
                        @if(Auth::user()->role == 0)
                        <li class="active"><a href="{{URL::action('AdminController@getShow')}}">Admin Manager</a></li>
                        @endif
                    @endif
                    
                </ul>

                <ul class="nav navbar-nav navbar-right">                    
                    @if (Auth::check())
                        <form id="socialLogin" class="navbar-form pull-right">
                            <p><span class="_hello">Hello</span> <b>{{HTML::linkAction('UserController@getShow',Auth::user()->username,array(Auth::user()->id)) }}</b>    {{ HTML::linkAction('AuthenController@getLogout','Logout', null, array('class' => '_logout')) }}  </p>
                        </form>            
                        @else
                        <li>{{ HTML::linkAction('AuthenController@getLogin','Login',array(), array('class' => 'navbar-btn ')) }} </li>
                        
                        <li>{{ HTML::linkAction('AuthenController@getSignup','Sign Up',array(), array('class' => 'navbar-btn ')) }} </li>
                        @endif
                </ul>

                
                {{ Form::open(array('action' => 'HomeController@search', 'method' => 'get')) }}
                <ul class="nav navbar-right">
                    <div class="box">
                      <div class="container-4">
                        <input type="search" name="search" id="search" placeholder="Search..." />
                        <button type="submit" id="submit" class="icon"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                </ul>

                {{ Form::close() }}
            </div>
          </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#"><i class="fa fa-home fa-fw"></i>User</a></li>
                        <li>{{HTML::linkAction('AdminController@showUser','User Manager')}} <i class="fa fa-list-alt fa-fw"></i></li>
                        <li>{{HTML::linkAction('AdminController@showDeactiveUser','Banned Users')}} <i class="fa fa-list-alt fa-fw"></i></li>
                        <li>{{HTML::linkAction('AdminController@addUser','Add User')}} <i class="fa fa-file-o fa-fw"></i></li>
                        <li class="active"><a href="#"><i class="fa fa-home fa-fw"></i>Item</a></li>
                        <li>{{HTML::linkAction('AdminController@showItem','Item Manager')}}<i class="fa fa-file-o fa-fw"></i></li>
                        <li>{{HTML::linkAction('AdminController@addItem','Add Item')}}<i class="fa fa-file-o fa-fw"></i></li>
                        <li class="active"><a href="#"><i class="fa fa-home fa-fw"></i>Bill</a></li>
                        <li>{{HTML::linkAction('AdminController@showBill','Bill Manager')}}<i class="fa fa-file-o fa-fw"></i></li>
                        <li class="active"><a href="#"><i class="fa fa-home fa-fw"></i>System</a></li>
                        <li>{{HTML::linkAction('AdminController@showSystemVar','System Manager')}}<i class="fa fa-file-o fa-fw"></i></li>
                       
                    </ul>
                </div>
                <div class="col-md-9 well">
                    {{$content}}  
                </div>
            </div>
        </div>

       
        <!-- /container -->
        

        <!-- Placed at the end of the document so the pages load faster -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script> 
        {{ HTML::script('js/bootstrap.js'); }} 
        {{ HTML::script('js/jquery-2.1.1.js'); }} 
        {{ HTML::script('js/bootstrap.min.js'); }}
        {{ HTML::script('js/jquery.runner-min.js'); }}
        {{ HTML::script('js/jquery.confirm.min.js'); }}


        <script type="text/javascript">
        $(function() {
            $('#search').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    $('#submit').click();
                }
            });
        }
        </script>
        @section('javascript') 
        @show

    </body>
</html>

