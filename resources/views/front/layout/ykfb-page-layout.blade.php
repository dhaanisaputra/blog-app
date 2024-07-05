<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0 maximum-scale=5" name="viewport">

    <title>@yield('pageTitle')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @yield('meta_tags')
    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ url('/back/dist/img/logo-favicon/' . blogInfo()->blog_favicon) }}"
        type="image/x-icon">
    <link rel="icon" href="{{ url('/back/dist/img/logo-favicon/' . blogInfo()->blog_favicon) }}"
        type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/back/zenblog/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/back/zenblog/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/back/zenblog/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/back/zenblog/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/back/zenblog/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS Files -->
    <link href="/back/zenblog/css/variables.css" rel="stylesheet">
    <link href="/back/zenblog/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: ZenBlog
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    @include('front.layout.inc.ykfb-header')

    <main id="main">

        <!-- ======= Post Grid Section ======= -->
        <section class="section">
            <div class="container" data-aos="fade-up">
                @yield('content-ykfb')
            </div>
        </section>
        <!-- End Post Grid Section -->

    </main><!-- End #main -->

    @include('front.layout.inc.ykfb-footer')

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/back/zenblog/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/back/zenblog/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/back/zenblog/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/back/zenblog/vendor/aos/aos.js"></script>
    <script src="/back/zenblog/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/back/zenblog/js/main.js"></script>

</body>

</html>
