@extends('front.layout.ykfb-page-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Welcome To Yogyakarta Fingerboard Community')
@section('content-ykfb')

    <section>
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h2 class="display-4">Fingerboarder of The Year Indonesia</h2>
                            <p>Fingerboarder of The Year (FoTY) Indonesia adalah penghargaan tahunan dari Papanjari
                                Indonesia untuk fingerboarder Indonesia terpilih.
                                Pemilihan dilakukan dengan cara voting pada akhir tahun melalui akun instagram Papanjari
                                Official.
                            </p>
                        </div>
                    </div>
                </div>
                @forelse ($data as $foty)
                    <div class="col-lg-4 text-center mb-5 mt-4">
                        <img src="{{ asset('back/dist/img/foty-upload/' . $foty->featured_image) }}" alt=""
                            class="img-fluid rounded-circle w-50 mb-4">
                        <h4>{{ $foty->name_foty }}</h4>
                        <span class="d-block mb-3 text-uppercase">Fingerboarder of The Year {{ $foty->year_foty }}</span>
                        <p>{!! $foty->post_content !!}</p>
                    </div>
                @empty
                    <span class="text-danger">No FoTY found in this category.</span>
                @endforelse
            </div>
        </div>
    </section>
@endsection
