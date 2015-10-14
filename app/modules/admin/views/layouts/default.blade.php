<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
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
	<title>Dashboard</title>
</head>
<body>
	@include('admin::layouts.header')
		@yield('content')
	@include('admin::layouts.footer')
	
	 <!-- CORE JQUERY SCRIPTS -->
	{{HTML::script('public/backend/assets/js/jquery-1.11.1.js')}}
	<!-- BOOTSTRAP SCRIPTS  -->
	{{HTML::script('public/backend/assets/js/bootstrap.js')}}
	{{HTML::script('public/backend/assets/js/ckeditor/ckeditor.js')}}

	{{HTML::script('public/backend/assets/js/alert/alertify.js')}}
	{{HTML::style('public/backend/assets/js/alert/alertify.css')}}
	{{HTML::style('public/backend/assets/js/alert/semantic.min.css')}}

	@yield('script')
</body>
</html>