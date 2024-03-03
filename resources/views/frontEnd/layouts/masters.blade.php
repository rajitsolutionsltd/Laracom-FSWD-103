<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Broccoli - Organic Food HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/font-icons.css') }}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/plugins.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/responsive.css') }}">

    @stack('styles')
</head>

<body>
    <div class="body-wrapper">

        <!-- HEADER AREA START (header-5) -->
        @include('frontEnd.inc.header')
        <!-- HEADER AREA END -->

        <!-- Utilize Cart Menu Start -->
        @include('frontEnd.inc.cart')
        <!-- Utilize Cart Menu End -->

        <!-- Utilize Mobile Menu Start -->
        @include('frontEnd.inc.mobile_menu')
        <!-- Utilize Mobile Menu End -->

        <div class="ltn__utilize-overlay"></div>

        <!-- SLIDER AREA START (slider-3) -->
        @include('frontEnd.inc.slider')
        <!-- SLIDER AREA END -->

        @yield('content')
        <!-- MODAL AREA START -->
        @include('frontEnd.inc.whitelist_modal')
        <!-- MODAL AREA END -->

    </div>
    <!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- All JS Plugins -->
    <script src="{{ asset('frontend_assets/js/plugins.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('frontend_assets/js/main.js') }}"></script>

    @stack('scripts')

</body>

</html>
