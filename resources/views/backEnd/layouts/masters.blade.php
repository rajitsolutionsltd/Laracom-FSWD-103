<!DOCTYPE html>
<html lang="en">

<head>
    @include('backEnd.inc.head')
</head>

<body>

    <!-- ======= Header ======= -->
    @include('backEnd.inc.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('backEnd.inc.sidebar')
    <!-- End Sidebar-->

    <main id="main" class="main">
        @include('backEnd.inc.breadcrumbs')
        <!-- End Page Title -->

        <section class="section">
            @yield('content')
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('backEnd.inc.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('backEnd.inc.footer_scripts')

</body>

</html>
