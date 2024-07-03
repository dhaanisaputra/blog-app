<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>@yield('pageTitle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    @yield('meta_tags')
    <link rel="shortcut icon" href="{{ url('/back/dist/img/logo-favicon/' . blogInfo()->blog_favicon) }}"
        type="image/x-icon">
    <link rel="icon" href="{{ url('/back/dist/img/logo-favicon/' . blogInfo()->blog_favicon) }}" type="image/x-icon">

    <!-- theme meta -->
    <meta name="theme-name" content="reporter" />

    <!-- # Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="/front/plugins/bootstrap/bootstrap.min.css">
    <style>
        #backToTop {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgb(235, 118, 16) 100vh, red 0);
            border-radius: 0.5rem;
            padding: 0.5rem;
            text-decoration: none;
        }
    </style>

    <!-- # Main Style Sheet -->
    <link rel="stylesheet" href="/front/css/style.css">
</head>

<body>

    @include('front.layout.inc.header')

    <main>
        <section class="section">
            <div class="container">
                @yield('content')
            </div>
        </section>
    </main>
    <span id="backToTop">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
            style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
            <path d="m6.293 11.293 1.414 1.414L12 8.414l4.293 4.293 1.414-1.414L12 5.586z"></path>
            <path d="m6.293 16.293 1.414 1.414L12 13.414l4.293 4.293 1.414-1.414L12 10.586z"></path>
        </svg>
    </span>
    @include('front.layout.inc.footer')

    <!-- # JS Plugins -->
    <script src="/front/plugins/jquery/jquery.min.js"></script>
    <script src="/front/plugins/bootstrap/bootstrap.min.js"></script>

    <!-- Main Script -->
    <script src="/front/js/script.js"></script>

    <!-- Back to Top -->
    <script>
        $(document).ready(function() {
            // Show or hide the button based on scroll position
            $(window).scroll(function() {
                if ($(this).scrollTop() > 150) {
                    $('#backToTop').fadeIn();
                } else {
                    $('#backToTop').fadeOut();
                }
            });
            // Scroll to top when the button is clicked
            $('#backToTop').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
    </script>

</body>

</html>
