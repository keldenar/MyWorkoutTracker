<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Exercise Tracker</title>

    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
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
    <div class="header col-md-8 col-md-offset-2">
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



    <footer class="navbar-default navbar-fixed-bottom">
            <div class="row">
                <div class="fb-like col-md-2" data-share="true" data-width="450" data-show-faces="true"></div>
                <div class="col-md-2"><a href="{{ url("faq") }}">FAQs</a></div>
                <div class="col-md-2 col-md-offset-1"><a href="#">Privacy Policy</a></div>
                <div class="col-md-2 col-md-offset-1"><a href="#">Suggest an Exercise</a></div>
            </div>
    </footer>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/js/moment/moment.js"></script>
    <script src="/js/workout.js"></script>
    <script src="/js/bootstrap.js"></script>

    <script type="text/javascript" src="/js/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-64457519-1', 'auto');
        ga('send', 'pageview');

    </script>

</body>
</html>
