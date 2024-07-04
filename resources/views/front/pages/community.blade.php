@extends('front.layout.page-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Welcome To Yogyakarta Fingerboard Community')
@section('content')
    <div class="page-wrapper">
        <h4 class="page-title text-center">
            Page communities here...
        </h4>
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-4 d-none d-md-block border-end">
                            <div class="card-body">
                                <h4 class="subheader">Daftar Komunitas</h4>
                                <div class="list-group list-group-transparent">
                                    @php
                                        $getCommunity = App\Models\Community::all();
                                    @endphp
                                    @foreach ($getCommunity as $community)
                                        <div>
                                            <a href=""
                                                class="list-group-item list-group-item-action d-flex align-items-center">{{ $community->communities_title }}</a>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="col d-flex flex-column">
                            <div class="card-body">
                                <h2 class="mb-4">Tentang Komunitas</h2>

                                <p class="card-subtitle">Making your profile public means that anyone on the Dashkit network
                                    will be able to find
                                    you.</p>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row g-5 ml-4">
        <div class="col-lg-4 border border-slate-600">
            @php
                $getCommunity = App\Models\Community::all();
            @endphp
            @foreach ($getCommunity as $community)
                <div>
                    <a href="">{{ $community->communities_title }}</a>
                </div>
            @endforeach
        </div>
        <div class="col-lg-8">
            <div>
                1
            </div>
            <div>
                2
            </div>
            <div>
                3
            </div>
            <div>
                4
            </div>
        </div>
    </div> --}}
    <!-- ======= Hero Slider Section ======= -->
    {{-- <section id="hero-slider" class="hero-slider">
        <div class="container-md" data-aos="fade-in">
            <div class="row">
                <div class="col-12">
                    <div class="swiper sliderFeaturedPosts">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="single-post.html" class="img-bg d-flex align-items-end"
                                    style="background-image: url('/back/dist/img/img-slider/post-slide-1.jpg');">
                                    <div class="img-bg-inner">
                                        <h2>The Best Homemade Masks for Face (keep the Pimples Away)</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est
                                            mollitia! Beatae minima assumenda repellat harum vero, officiis ipsam magnam
                                            obcaecati cumque maxime inventore repudiandae quidem necessitatibus rem atque.
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="single-post.html" class="img-bg d-flex align-items-end"
                                    style="background-image: url('/back/dist/img/img-slider/post-slide-2.jpg');">
                                    <div class="img-bg-inner">
                                        <h2>17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut
                                        </h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est
                                            mollitia! Beatae minima assumenda repellat harum vero, officiis ipsam magnam
                                            obcaecati cumque maxime inventore repudiandae quidem necessitatibus rem atque.
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="single-post.html" class="img-bg d-flex align-items-end"
                                    style="background-image: url('/back/dist/img/img-slider/post-slide-3.jpg');">
                                    <div class="img-bg-inner">
                                        <h2>13 Amazing Poems from Shel Silverstein with Valuable Life Lessons</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est
                                            mollitia! Beatae minima assumenda repellat harum vero, officiis ipsam magnam
                                            obcaecati cumque maxime inventore repudiandae quidem necessitatibus rem atque.
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="single-post.html" class="img-bg d-flex align-items-end"
                                    style="background-image: url('/back/dist/img/img-slider/post-slide-4.jpg');">
                                    <div class="img-bg-inner">
                                        <h2>9 Half-up/half-down Hairstyles for Long and Medium Hair</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est
                                            mollitia! Beatae minima assumenda repellat harum vero, officiis ipsam magnam
                                            obcaecati cumque maxime inventore repudiandae quidem necessitatibus rem atque.
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="custom-swiper-button-next">
                            <span class="bi-chevron-right"></span>
                        </div>
                        <div class="custom-swiper-button-prev">
                            <span class="bi-chevron-left"></span>
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Hero Slider Section -->
@endsection
