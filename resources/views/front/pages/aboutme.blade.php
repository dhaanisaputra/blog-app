@extends('front.layout.page-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Welcome To Yogyakarta Fingerboard Community')
@section('content')

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title text-center">
                            Yogyakarta Fingerboard Community
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-7">
                        <div class="card card-lg">
                            <div class="card-body markdown">
                                <h4 class="card-title text-muted">Awal berdirinya komunitas Yogyakarta Fingerboard
                                </h4>
                                <p class="text-justify">Bisa dibilang kita mulai exist sekitar tahun 2009. Yang mendasari
                                    terbentuknya komunitas Yogyakarta Fingerboard ini ya karena kita semua pada waktu
                                    itu sangat antusias bermain dengan papan jari / <em>fingerboard</em>,
                                    sesama penggiat hobi kita sering kumpul setiap malam ataupun weekend di sebuah kedai
                                    kopi wilayah Jogja ataupun di toko "Yogyakarta Fingerboardshop" (yang saat itu masih
                                    ada)
                                    dan terbentuklah
                                    teman-teman keluarga <strong>Yogyakarta Fingerboarder Community</strong> hingga
                                    sekarang. Komunitas menjadi wadah bagi temen-temen untuk berkumpul bermain bersama dan
                                    juga membantu <em>fingerboarder</em> baru yang ingin tahu lebih dalam tentang
                                    <em>fingerboard</em>
                                    ataupun ingin
                                    menjalin relasi pertemanan sesama <em>fingerboarder</em>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- <div class="page-wrapper">
        <div class="card-body">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title text-center">
                                Yogyakarta Fingerboard Community
                            </h2><br>
                            <h4 class="card-title text-muted">Awal berdirinya komunitas Yogyakarta Fingerboard
                            </h4>
                            <p class="text-center">Bisa dibilang kita mulai exist sekitar tahun 2009. Yang mendasari
                                terbentuknya komunitas Yogyakarta Fingerboard ini ya karena kita semua pada waktu
                                itu sangat antusias dengan papan jari / fingerboard,
                                sesama penggiat hobi kita sering kumpul tiap malam ataupun weekend dan terbentuklah
                                teman-teman
                                kita
                                ini menjadi
                                keluarga Yogyakarta Fingerboarder Community hingga sekarang. Komunitas menjadi wadah bagi
                                yang
                                ingin
                                lebih kenal dan ingin tahu tentang fingerboard ataupun ingin
                                menjalin relasi dg temen2 sesama fingerboarder.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <!-- Content here -->
                </div>
            </div>
        </div>
    </div> --}}
@endsection
