@extends('front.layout.ykfb-page-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Welcome To Yogyakarta Fingerboard Community')
@section('content-ykfb')

    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 text-center mb-2">
                <h1 class="page-title">About us</h1>
            </div>
        </div>

        <div class="row mb-5">

            <div class="d-md-flex post-entry-2 half">
                <a href="#" class="me-2 img-thumbnail border-0">
                    <img src="{{ url('/back/dist/img/logo-favicon/' . blogInfo()->blog_logo) }}" alt=""
                        class="img-fluid">
                </a>
                <div class="ps-md-5 mt-4 mt-md-0">
                    <div class="post-meta mt-2"></div>
                    <h2 class="mb-4 display-4">Yogyakarta Fingerboard Community History</h2>

                    <p style="text-align: justify">Bisa dibilang kita mulai exist sekitar tahun 2009. Yang mendasari
                        terbentuknya komunitas Yogyakarta Fingerboard ini ya karena kita semua pada waktu
                        itu sangat antusias bermain dengan papan jari / <em>fingerboard</em>,
                        sesama penggiat hobi kita sering kumpul setiap malam ataupun weekend di sebuah kedai
                        kopi wilayah Jogja ataupun di toko "Yogyakarta Fingerboardshop" (yang saat itu masih
                        ada) dan terbentuklah teman-teman keluarga <strong>Yogyakarta Fingerboarder
                            Community</strong> hingga sekarang. Komunitas menjadi wadah bagi temen-temen untuk
                        berkumpul bermain bersama dan
                        juga membantu <em>fingerboarder</em> baru yang ingin tahu lebih dalam tentang
                        <em>fingerboard</em>
                        ataupun ingin
                        menjalin relasi pertemanan sesama <em>fingerboarder</em>.
                    </p>
                </div>
            </div>

            <div class="d-md-flex post-entry-2 half mt-5">
                <a href="#" class="me-4 img-thumbnail border-0 order-2">
                    <img src="{{ url('/back/dist/img/img-slider/ykfb-oak.jpg') }}" alt="" class="img-fluid">
                </a>
                <div class="pe-md-5 mt-4 mt-md-0">
                    <div class="post-meta mt-0"></div>
                    <h2 class="mb-4 display-4">Mission &amp; Vision</h2>

                    <p style="text-align: justify"><em>Fingerboard</em> saat ini merupakan salah satu hobi yang tidak
                        mengenal
                        batasan usia dalam memainkannya. Demi membangun konsistensi dan eksistensi dalam skena
                        <em>fingerboard</em>
                        di Indonesia, Yogyakarta Fingerboard Community dibentuk untuk menjadi wadah bagi
                        <em>fingerboarder</em>
                        yogyakarta.
                    </p>
                    <p style="text-align: justify">Menjadi wadah yang supportif untuk <em>fingerboarder</em> yogyakarta
                        tentu menjadi
                        tujuan kami.
                        Dengan adanya kegiatan "meet up" kami berbagi ilmu dengan teman-teman, baik berbagi informasi
                        seputar <em>fingerboard</em> ataupun berbagi tips & trick dalam bermain <em>fingerboard</em>. Kami
                        senang jika
                        regenerasi
                        terus berjalan.</p>
                </div>
            </div>

        </div>

    </div>

    {{-- <section class="mb-5 bg-light py-5">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row justify-content-between align-items-lg-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h2 class="display-4 mb-4">Latest News</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, rem eaque vel est asperiores iste
                        pariatur placeat molestias, rerum provident ea maiores debitis eum earum esse quas architecto!
                        Minima, voluptatum! Minus tempora distinctio quo sint est blanditiis voluptate eos. Commodi
                        dolore nesciunt culpa adipisci nemo expedita suscipit autem dolorum rerum?</p>
                    <p>At magni dolore ullam odio sapiente ipsam, numquam eius minus animi inventore alias quam fugit
                        corrupti error iste laboriosam dolorum culpa doloremque eligendi repellat iusto vel impedit odit
                        cum. Sequi atque molestias nesciunt rem eum pariatur quibusdam deleniti saepe eius maiores porro
                        quam, praesentium ipsa deserunt laboriosam adipisci. Optio, animi!</p>
                    <p><a href="#" class="more">View All Blog Posts</a></p>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <img src="assets/img/post-portrait-3.jpg" alt="" class="img-fluid mb-4">
                        </div>
                        <div class="col-6 mt-4">
                            <img src="assets/img/post-portrait-4.jpg" alt="" class="img-fluid mb-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <section>
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h2 class="display-4">Our Team</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil sint sed, fugit distinctio
                                ad eius itaque deserunt doloribus harum excepturi laudantium sit officiis et eaque
                                blanditiis. Dolore natus excepturi recusandae.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center mb-5">
                    <img src="assets/img/person-1.jpg" alt="" class="img-fluid rounded-circle w-50 mb-4">
                    <h4>Cameron Williamson</h4>
                    <span class="d-block mb-3 text-uppercase">Founder &amp; CEO</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime,
                        adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident
                        inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam
                        temporibus aut!</p>
                </div>
                <div class="col-lg-4 text-center mb-5">
                    <img src="assets/img/person-2.jpg" alt="" class="img-fluid rounded-circle w-50 mb-4">
                    <h4>Wade Warren</h4>
                    <span class="d-block mb-3 text-uppercase">Founder, VP</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime,
                        adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident
                        inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam
                        temporibus aut!</p>
                </div>
                <div class="col-lg-4 text-center mb-5">
                    <img src="assets/img/person-3.jpg" alt="" class="img-fluid rounded-circle w-50 mb-4">
                    <h4>Jane Cooper</h4>
                    <span class="d-block mb-3 text-uppercase">Editor Staff</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime,
                        adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident
                        inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam
                        temporibus aut!</p>
                </div>
                <div class="col-lg-4 text-center mb-5">
                    <img src="assets/img/person-4.jpg" alt="" class="img-fluid rounded-circle w-50 mb-4">
                    <h4>Cameron Williamson</h4>
                    <span class="d-block mb-3 text-uppercase">Editor Staff</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime,
                        adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident
                        inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam
                        temporibus aut!</p>
                </div>
                <div class="col-lg-4 text-center mb-5">
                    <img src="assets/img/person-5.jpg" alt="" class="img-fluid rounded-circle w-50 mb-4">
                    <h4>Cameron Williamson</h4>
                    <span class="d-block mb-3 text-uppercase">Editor Staff</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime,
                        adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident
                        inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam
                        temporibus aut!</p>
                </div>
                <div class="col-lg-4 text-center mb-5">
                    <img src="assets/img/person-6.jpg" alt="" class="img-fluid rounded-circle w-50 mb-4">
                    <h4>Cameron Williamson</h4>
                    <span class="d-block mb-3 text-uppercase">Editor Staff</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime,
                        adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident
                        inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam
                        temporibus aut!</p>
                </div>
            </div>
        </div>
    </section> --}}

@endsection
