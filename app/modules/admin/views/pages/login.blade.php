<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
        <title>Dashboard Login</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        {{HTML::style('public/backend/assets/css/bootstrap.css')}}
        <!-- FONT AWESOME ICONS  -->
        {{HTML::style('public/backend/assets/css/font-awesome.css')}}
        <!-- CUSTOM STYLE  -->
        {{HTML::style('public/backend/assets/css/style.css')}}
        <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header>
            
        </header>
        <!-- HEADER END-->
        
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="page-head-line">Please Login To Dashboard </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        {{Form::open(array('route'=>'postLogin') )}}
                        {{Form::label('Enter email or username')}}
                        {{Form::text('email',Input::old('email'), array('class'=>'form-control') )}}
                        {{Form::label('Enter password')}}
                        {{Form::password('password', array('class'=>'form-control') )}}
                        <hr />
                        {{Form::submit('Log in me',array('class'=>'btn btn-info') )}}
                        <a href="{{route('admin.account.forget')}}" class="forget" style="display:inline-block; text-align:right; float:right">Forget the password ?</a>
                        {{Form::close()}}
                        
                        
                        @if (Session::get('error'))
                            <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
                        @endif

                        @if (Session::get('notice'))
                            <div class="alert alert-success">{{{ Session::get('notice') }}}</div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        &copy; 2015 YourCompany | By : <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY SCRIPTS -->
        {{HTML::script('public/backend/assets/js/jquery-1.11.1.js')}}
        <!-- BOOTSTRAP SCRIPTS  -->
        {{HTML::script('public/backend/assets/js/bootstrap.js')}}
        <!-- ALERTIFY -->
        {{HTML::script('public/backend/assets/js/alert/alertify.js')}}
        {{HTML::style('public/backend/assets/js/alert/alertify.core.css')}}
        {{HTML::style('public/backend/assets/js/alert/alertify.bootstrap.css')}}
        <script type="text/javascript">
                {{Notification::showSuccess('alertify.success(":message");') }}
                {{Notification::showError('alertify.error(":message");') }}
        </script>
    </body>
</html>