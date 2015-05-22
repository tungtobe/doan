<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Tung Mobile</title>

    <!-- Bootstrap Core CSS -->
    {{ HTML::style('css/bootstrap.css')}}
    {{ HTML::style('css/bootstrap.min.css')}}

    <!-- Custom CSS -->
    {{ HTML::style('css/sb-admin.css') }}

    <!-- Morris Charts CSS -->
    {{ HTML::style('css/morris.css') }}

    <!-- Custom Fonts -->
    {{ HTML::style('css/font-awesome.css') }}
    {{ HTML::style('css/font-awesome.min.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Placed at the end of the document so the pages load faster -->



{{ HTML::script('js/jquery-1.9.1.js'); }}


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{URL::action('HomeController@showWelcome')}}">TUNG MOBILE Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        {{Auth::user()->username}} 
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                             {{HTML::linkAction('UserController@getShow', 'Profile' ,array(Auth::user()->id), array('class' => 'glyphicon glyphicon-user')) }}
                        </li>
                        <li class="divider"></li>
                        <li>
                            {{ HTML::linkAction('AuthenController@getLogout','Logout', null, array('class' => 'glyphicon glyphicon-off')) }}
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    
                    <li>
                        <a ><i class="glyphicon glyphicon-phone-alt"></i> Item </a>
                        <ul >
                            <li>{{HTML::linkAction('AdminController@showItem','Item Manager')}}</li>
                            <li>{{HTML::linkAction('AdminController@addItem','Add Item')}}</li>
                            
                        </ul>
                    </li>

                    <li>
                        <a ><i class="glyphicon glyphicon-phone-alt"></i> Attribute </a>
                        <ul >
                            <li>{{HTML::linkAction('AdminController@showAttribute','Attribute Manager')}}</li>
                            <li>{{HTML::linkAction('AdminController@addAttribute','Add Attribute')}}</li>
                            
                        </ul>
                    </li>

                    <li>
                        <a ><i class="glyphicon glyphicon-user"></i> User Manager</a>
                        <ul >
                            <li>{{HTML::linkAction('AdminController@showUser','User Manager')}}</li>
                            <li>{{HTML::linkAction('AdminController@showDeactiveUser','Banned Users')}}</li>
                            <li>{{HTML::linkAction('AdminController@addUser','Add User')}} </li>
                            
                        </ul>
                    </li>

                    <li>
                        <a href="{{URL::action('AdminController@showBill')}}"><i class='glyphicon glyphicon-usd'></i> Bill Manager</a>
                    </li>

                    <li>
                        <a href="{{URL::action('AdminController@showSystemVar')}}"><i class='glyphicon glyphicon-wrench'></i> System Manager</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                {{$content}} 

               
       

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

        {{ HTML::script('js/jquery.js'); }} 
        {{ HTML::script('js/bootstrap.min.js'); }}

        {{ HTML::script('js/jquery.confirm.min.js'); }}



        {{ HTML::script('js/jquery.form.js'); }} 
        {{ HTML::script('js/jquery.runner-min.js'); }}
</body>

</html>
