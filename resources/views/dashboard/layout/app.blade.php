<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title -->
    <title>Dashboard - SDN Srengseng Sawah 11</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="">

    <meta name="keywords" content="admin dashboard, admin template, administration, analytics, bootstrap, disease, doctor, elegant, health, hospital admin, medical dashboard, modern, responsive admin dashboard">
    <meta name="description" content="Mediqu. is a Fully Mobile Responsive Admin Dashboard Templates for Hospitals dentists, doctors, surgeons, hospitals, health clinics, pediatrics, psychiatrist, psychiatry, stomatology, chiropractor, veterinary clinics. This minimal template is being packed with tons of features like Dashboard Pages, Elements pages, Shop/Store Pages, Product Pages, All Inner Pages with Total 70+ HTML Files. Mediqu. is designed for especially Mobile devices and all types of modern browsers.">

    <meta property="og:title" content="Mediqu  - Hospital Admin Dashboard Bootstrap Template">
    <meta property="og:description" content="Mediqu. is a Fully Mobile Responsive Admin Dashboard Templates for Hospitals dentists, doctors, surgeons, hospitals, health clinics, pediatrics, psychiatrist, psychiatry, stomatology, chiropractor, veterinary clinics. This minimal template is being packed with tons of features like Dashboard Pages, Elements pages, Shop/Store Pages, Product Pages, All Inner Pages with Total 70+ HTML Files. Mediqu. is designed for especially Mobile devices and all types of modern browsers.">
    <meta property="og:image" content="{{ asset('assets/images/layout/logo-sekolah.png') }}">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->
    <link href="{{ asset('assets/images/layout/logo-sekolah.png') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('assets/dashboard/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/chartist/css/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/pickdate/themes/default.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/pickdate/themes/default.date.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/vendor/summernote/summernote.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/dashboard/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->

    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="#" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('images/layout/logo-sekolah.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('images/layout/logo-text.png') }}" alt="">
                <img class="brand-title" src="{{ asset('images/layout/logo-text.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Chat box start
        ***********************************-->
        
        <!--**********************************
            Chat box End
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @include('dashboard.layout.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('dashboard.layout.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Appointment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Patient Name</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Brian Lucky">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput2" class="form-label">Patient Number</label>
                                        <input type="number" class="form-control" id="exampleFormControlInput2" placeholder="+123456789">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput3" placeholder="name@example.com">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->


        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        @include('dashboard.layout.footer')
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets/dashboard/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/dashboard/vendor/apexchart/apexchart.js') }}"></script> -->
    <script src="{{ asset('assets/dashboard/vendor/pickdate/picker.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/pickdate/picker.time.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/pickdate/picker.date.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/vendor/summernote/summernote.min.js') }}"></script>

    <!-- Dashboard 1 -->
    <!-- <script src="{{ asset('assets/dashboard/js/dashboard/dashboard-1.js') }}"></script> -->
    <script src="{{ asset('assets/dashboard/js/dashboard/cms.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/deznav-init.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/demo.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/styleSwitcher.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            setTimeout(function() {
                dezSettingsOptions.version = 'dark';
                new dezSettings(dezSettingsOptions);
            }, 1000)
            jQuery(window).on('resize', function() {
                dezSettingsOptions.version = 'dark';
                new dezSettings(dezSettingsOptions);
                jQuery('.dz-theme-mode').addClass('active');
            })
        });
    </script>

    @stack('scripts')
</body>

</html>