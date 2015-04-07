<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Quickleave | Register</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/theme/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/theme/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="/landtheme/css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/landtheme/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <style type="text/css">
    body {
    background-image: url(/img/header-bg.jpg);
    background-position: center center;
    background-repeat: none;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;
    }
    </style>

  </head>
 <body class="login-page" id="page-top" class="index">

<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">QuickLeave</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="login">Log In</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

<br><br>
    <div class="register-box">
      <div class="register-box-body">
        <p class="login-box-msg"><b>REGISTER</b></p>
        @if (Session::has('message'))
          <div class="alert alert-info">{!! Session::get('message') !!}</div>
        @endif

        @if ($errors->has())
            <div class="alert alert-danger">
              <center><strong>WARNING!</strong></center><br>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>        
                @endforeach
            </div>
        @endif

      <div class="container-fluid">
        <form role="form" method="POST" action="/auth/register">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group has-feedback">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                </div>
            <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" />
            </div>
          </div>

          <div class= "row" style="margin-bottom: 15px">
            <div class="col-md-6 col-xs-6" class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password"/> 
            </div>

            <div class="col-md-6 col-xs-6" class="form-group">
              <input type="password" class="form-control" name="password_confirmation" placeholder="Retype Password"/> 
            </div>          
          </div> <!--row -->

          <div class="form-group has-feedback">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                </div>
            <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="{{ old('firstname') }}"/>
            </div>
          </div>
          <div class="form-group has-feedback">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                </div>
            <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="{{ old('lastname') }}"/>
            </div>
          </div>

          <div class="form-group has-feedback">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="glyphicon glyphicon-envelope"></i>
                </div>
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}"/>
            </div>
          </div>

          <div class="form-group has-feedback">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-chevron-down"></i>
            </div>
            {!! Form::select('gender', array('' => 'Select gender', 'M' => 'Male', 'F' => 'Female'), Input::old('gender'), array('class' => 'form-control', 'placeholder' => 'Select Gender')) !!}
          </div>

          <div class="form-group has-feedback" style="margin-top: 15px">
            <div class="input-group">
            <div class="input-group-addon">
                <i class="glyphicon glyphicon-lock"></i>
            </div>
            <input type="text" class="form-control" name="team_code" placeholder="Team Code" value="{{ old('team_code') }}"/>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-8" style="padding-top: 5px"> 
             <a href="login"> Already a member? </a>                    
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-right: 15px;">
                  SUBMIT
                </button>
            </div><!-- /.col -->
          </div>

        </form>        
      </div>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="/theme/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/theme/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="/theme/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>