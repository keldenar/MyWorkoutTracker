<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/workout.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    <div class="header clearfix col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-2">
                <h3 class="text-center">Exercise Tracker</h3>
            </div>
            <div class="col-md-3 pull-right">
                <nav>
                    @include('userMenu')
                </nav>
            </div>
        </div>

    </div>

	@yield('content')


    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-md-offset-2"><a href="{{ url("faq") }}">FAQs</a></div>
                <div class="col-md-2 col-md-offset-1"><a href="#">Privacy Policy</a></div>
                <div class="col-md-2 col-md-offset-1"><a href="#">Suggest an Exercise</a></div>
            </div>
        </div>
    </footer>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/js/moment/moment.js"></script>
    <script src="/js/workout.js"></script>
    <script src="/js/bootstrap.js"></script>

    <script type="text/javascript" src="/js/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

</body>
</html>
