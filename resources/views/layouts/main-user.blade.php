
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Diagnostic Online Website of Physics</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		@include('partials.css')
		@yield('css-custom')
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  	<![endif]-->

	  	<!-- Google Font -->
	  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
	<body class="skin-blue layout-top-nav" data-gr-c-s-loaded="true" style="height: auto; min-height: 100%;">
		<div class="wrapper">
			@include('partials.header')
			<div class="content-wrapper">
				<div class="container">
  					<!-- Content Header (Page header) -->
  					<section class="content-header">
    					@yield('content-header')
  					</section>

  					<!-- Main content -->
  					<section class="content">
    					@yield('content')
  					</section>
  					<!-- /.content -->
				</div>
			</div>
			<!-- /.container -->
  			<!-- /.content-wrapper -->
  			<footer class="main-footer">
    			<div class="container">
      				<div class="pull-right hidden-xs">
        				<b>Version</b> 1.0
      				</div>
      				<strong>Copyright &copy; 2019 <a href="#">Diagnostic Online Website of Physics</a>.</strong> All rights reserved.
    			</div>
    			<!-- /.container -->
  			</footer>
		</div>
		<!-- ./wrapper -->

		@include('partials.js')
		@yield('js-custom')
	</body>
</html>
