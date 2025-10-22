<!Doctype html>
<html class="no-js" lang="zxx">

<head>
    <title>{{ isset($detailMenu) ? $detailMenu . ' - ' : '' }}SDN Srengseng Sawah 11</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/layout/logo-sekolah.png') }}">

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="index, follow">
    <meta name="description" content="{{ isset($detailMenu) ? $detailMenu . ' - ' : '' }}Website Resmi SDN Srengseng Sawah 11">
    <meta name="keywords" content="sdnss11, sdn srengseng sawah 11, sekolah dasar negeri srengseng sawah sebelas pagi">
    <meta name="author" content="SDN Srengseng Sawah 11, srengsengsawah.sdnss11@gmail.com">

    <meta name="og:title" content="{{ isset($detailMenu) ? $detailMenu . ' - ' : '' }}SDN Srengseng Sawah 11">
    <meta name="og:type" content="{{ isset($berita) && isset($berita->title) ? 'blog' : 'website' }}">
    <meta name="og:url" content="{{ url()->current() }}">
    <meta name="og:site_name" content="Website Resmi SDN Srengseng Sawah 11">
    <meta name="og:description" content="Website Resmi SDN Srengseng Sawah 11">
    <meta name="og:image" content="{{ isset($berita) && isset($berita->thumbnail) ? asset('storage/images/berita/thumbnail/'.$berita->thumbnail) : asset('assets/images/layout/logo-sekolah.png') }}">

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

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

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