<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="theme/img/logo.png">

    <!-- Normalize CSS -->
    <link rel="stylesheet" href="theme/css/normalize.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="theme/css/main.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="theme/css/bootstrap.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="theme/css/animate.min.css">

    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="theme/css/font-awesome.min.css">

    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="theme/vendor/OwlCarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="theme/vendor/OwlCarousel/owl.theme.default.min.css">

    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="theme/css/meanmenu.min.css">

    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="theme/css/jquery.datetimepicker.css">

    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="theme/css/reImageGrid.css">

    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="theme/css/hover-min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="theme/style.css">

    <!-- Modernizr Js -->
    <script src="theme/js/modernizr-2.8.3.min.js"></script>

    <!-- Scripts -->
@yield('scripts', '')

<!-- Global Spark Object -->

    <script>
        window.Spark = @php echo json_encode(array_merge(
            Spark::scriptVariables(), []
        )); @endphp;
    </script>
</head>
<body>

<div id="wrapper">
    @include('theme.layout.header')

    <div id="spark-app" v-cloak>
        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Application Level Modals -->
        @if (Auth::check())
            @include('spark::modals.notifications')
            @include('spark::modals.support')
            @include('spark::modals.session-expired')
        @endif
    </div>

    @include('theme.layout.footer')
</div>

<!-- JavaScript -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="/js/sweetalert.min.js"></script>
<!-- jquery-->
<script src="theme/js/jquery-2.2.4.min.js" type="text/javascript"></script>

<!-- Plugins js -->
<script src="theme/js/plugins.js" type="text/javascript"></script>

<!-- Bootstrap js -->
<script src="theme/js/bootstrap.min.js" type="text/javascript"></script>

<!-- WOW JS -->
<script src="theme/js/wow.min.js"></script>

<!-- Owl Cauosel JS -->
<script src="theme/vendor/OwlCarousel/owl.carousel.min.js" type="text/javascript"></script>

<!-- Meanmenu Js -->
<script src="theme/js/jquery.meanmenu.min.js" type="text/javascript"></script>

<!-- Srollup js -->
<script src="theme/js/jquery.scrollUp.min.js" type="text/javascript"></script>

<!-- jquery.counterup js -->
<script src="theme/js/jquery.counterup.min.js"></script>
<script src="theme/js/waypoints.min.js"></script>

<!-- Isotope js -->
<script src="theme/js/isotope.pkgd.min.js" type="text/javascript"></script>

<!-- Gridrotator js -->
<script src="theme/js/jquery.gridrotator.js" type="text/javascript"></script>

<!-- Custom Js -->
<script src="theme/js/main.js" type="text/javascript"></script>
</body>
</html>
