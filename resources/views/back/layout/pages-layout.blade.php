<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    @php
        $getSetting = App\Models\Settings::getSingle();
    @endphp
    <link rel="icon" href="{{ url('/back/dist/img/logo-favicon/' . $getSetting->blog_favicon) }}" type="image/x-icon">
    <link href="/back/dist/css/tabler.min.css?1684106062" rel="stylesheet" />
    <link href="/back/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet" />
    <link href="/back/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet" />
    <link href="/back/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet" />
    {{-- --- toastr message --- --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}

    {{-- --- ijaboo crop tools image ---  --}}
    <link rel="stylesheet" href="/back/dist/libs/ijaboCropTool/ijaboCropTool.min.css">

    {{-- --- ckeditor --- --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script> --}}
    {{-- <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script> --}}

    {{-- --- amsify tags --- --}}
    <link rel="stylesheet" href="/amsify/amsify.suggestags.css">

    {{-- --- fontawesome --- --}}
    <link rel="stylesheet" href="/fontawesome-free-5.15.4-web/css/all.min.css">


    @stack('stylesheets')
    @livewireStyles
    <link href="/back/dist/css/demo.min.css?1684106062" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    <script src="/back/dist/js/demo-theme.min.js?1684106062"></script>
    <div class="page">
        <!-- Navbar -->
        @include('back.layout.inc.header')
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="container-xl">
                @yield('pageHeader')
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>
            @include('back.layout.inc.footer')
        </div>
    </div>


    <!-- Libs JS -->
    <script src="/back/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
    <script src="/back/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062" defer></script>
    <script src="/back/dist/libs/jsvectormap/dist/maps/world.js?1684106062" defer></script>
    <script src="/back/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Sweet Alert -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> --}}

    <!-- Toastr -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="/back/dist/libs/ijaboCropTool/ijaboCropTool.min.js"></script>
    <!-- Tabler Core -->
    <script src="/back/dist/js/tabler.min.js?1684106062" defer></script>
    <!-- Amsify Tags -->
    <script src="/amsify/jquery.amsify.suggestags.js"></script>

    @stack('scripts')
    @livewireScripts
    <script>
        $('input[name="post_tags"]').amsifySuggestags({
            tagLimit: 5
        });

        window.addEventListener('showToastr', function(event) {
            console.log(event);
            toastr.remove();
            if (event.detail[0].type === 'info') {
                toastr.info(event.detail[0].message);
            } else if (event.detail[0].type === 'success') {
                toastr.success(event.detail[0].message);
            } else if (event.detail[0].type === 'error') {
                toastr.error(event.detail[0].message);
            } else if (event.detail[0].type === 'warning') {
                toastr.warning(event.detail[0].message);
            } else {
                return false;
            }
        })
    </script>
    <script src="/back/dist/js/demo.min.js?1684106062" defer></script>

    {{-- @if (Session::has('message'))
        <script>
            toastr.options = {
                "progressbar" : true,
            }
            toastr.success("{{ Session::get('message')}}");
        </script>
    @endif --}}

    {{-- <!-- Initialize Toastr -->
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script> --}}
</body>

</html>
