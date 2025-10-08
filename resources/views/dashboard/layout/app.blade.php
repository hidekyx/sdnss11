<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('assets/images/layout/logo-sekolah.png') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="SDN Srengseng Sawah">
        <title>Dashboard - SDN Srengseng Sawah 11</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('assets/dashboard/css/app.css') }}" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="app">
        <!-- BEGIN: Mobile Menu -->
        @include('dashboard.layout.mobile-nav')
        <!-- END: Mobile Menu -->
        <!-- BEGIN: Top Bar -->
        @include('dashboard.layout.top-bar')
        <!-- END: Top Bar -->
        <!-- BEGIN: Top Menu -->
        @include('dashboard.layout.top-nav')
        <!-- END: Top Menu -->
        <!-- BEGIN: Content -->
        @yield('content')
        <!-- END: Content -->
        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{ asset('assets/dashboard/js/app.js') }}"></script>
        <!-- END: JS Assets-->
    </body>
</html>