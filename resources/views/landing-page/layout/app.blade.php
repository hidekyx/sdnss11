<!Doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SDN Srengseng Sawah 11</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/layout/logo-sekolah.png') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link href="{{ asset('assets/landing-page/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/css/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/css/odometer.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/css/meanmenu.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/css/swipper.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/css/main.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    @stack('styles')
</head>

<body>
    <!-- sidebar-information-area-start -->
    @include('landing-page.layout.sidebar')
    <!-- sidebar-information-area-end -->

    <!-- header area start -->
    @include('landing-page.layout.header')
    <!-- header area end -->

    <!-- search start area -->
    @include('landing-page.layout.search')
    <!-- search start end -->

    <main>
        @yield('content')
    </main>
    <!-- footer area start -->
    @include('landing-page.layout.footer')
    <!-- footer area end -->

    <!-- JS here -->
    <script src="{{ asset('assets/landing-page/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/js/swipper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/js/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/js/appear.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/js/main.js') }}"></script>
</body>

</html>