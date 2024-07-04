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
    <link href="back/zenblog/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="back/zenblog/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="back/zenblog/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="back/zenblog/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="back/zenblog/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS Files -->
    <link href="back/zenblog/css/variables.css" rel="stylesheet">
    <link href="back/zenblog/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: ZenBlog
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    @include('front.layout.inc.ykfb-header')
    <!-- End Header -->

    <main id="main">

        <!-- ======= Hero Slider Section ======= -->
        <section id="hero-slider" class="hero-slider">
            <div class="container-md" data-aos="fade-in">
                <div class="row">
                    <div class="col-12">
                        <div class="swiper sliderFeaturedPosts">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="single-post.html" class="img-bg d-flex align-items-end"
                                        style="background-image: url('back/zenblog/img/post-slide-1.jpg');">
                                        <div class="img-bg-inner">
                                            <h2>The Best Homemade Masks for Face (keep the Pimples Away)</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque
                                                est mollitia! Beatae minima assumenda repellat harum vero, officiis
                                                ipsam magnam obcaecati cumque maxime inventore repudiandae quidem
                                                necessitatibus rem atque.</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="single-post.html" class="img-bg d-flex align-items-end"
                                        style="background-image: url('back/zenblog/img/post-slide-2.jpg');">
                                        <div class="img-bg-inner">
                                            <h2>17 Pictures of Medium Length Hair in Layers That Will Inspire Your New
                                                Haircut</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque
                                                est mollitia! Beatae minima assumenda repellat harum vero, officiis
                                                ipsam magnam obcaecati cumque maxime inventore repudiandae quidem
                                                necessitatibus rem atque.</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="single-post.html" class="img-bg d-flex align-items-end"
                                        style="background-image: url('back/zenblog/img/post-slide-3.jpg');">
                                        <div class="img-bg-inner">
                                            <h2>13 Amazing Poems from Shel Silverstein with Valuable Life Lessons</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque
                                                est mollitia! Beatae minima assumenda repellat harum vero, officiis
                                                ipsam magnam obcaecati cumque maxime inventore repudiandae quidem
                                                necessitatibus rem atque.</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="single-post.html" class="img-bg d-flex align-items-end"
                                        style="background-image: url('back/zenblog/img/post-slide-4.jpg');">
                                        <div class="img-bg-inner">
                                            <h2>9 Half-up/half-down Hairstyles for Long and Medium Hair</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque
                                                est mollitia! Beatae minima assumenda repellat harum vero, officiis
                                                ipsam magnam obcaecati cumque maxime inventore repudiandae quidem
                                                necessitatibus rem atque.</p>
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
        </section><!-- End Hero Slider Section -->

        <!-- ======= Post Grid Section ======= -->
        <section id="posts" class="posts">
            <div class="container" data-aos="fade-up">
                @yield('content-ykfb')
            </div>
        </section> <!-- End Post Grid Section -->

        <!-- ======= Culture Category Section ======= -->
        <section class="category-section">
            <div class="container" data-aos="fade-up">

                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h2>Culture</h2>
                    <div><a href="category.html" class="more">See All Culture</a></div>
                </div>

                <div class="row">
                    <div class="col-md-9">

                        <div class="d-lg-flex post-entry-2">
                            <a href="single-post.html" class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                                <img src="back/zenblog/img/post-landscape-6.jpg" alt="" class="img-fluid">
                            </a>
                            <div>
                                <div class="post-meta"><span class="date">Culture</span> <span
                                        class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                <h3><a href="single-post.html">What is the son of Football Coach John Gruden, Deuce
                                        Gruden doing Now?</a></h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat
                                    exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error
                                    deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?
                                </p>
                                <div class="d-flex align-items-center author">
                                    <div class="photo"><img src="back/zenblog/img/person-2.jpg" alt=""
                                            class="img-fluid"></div>
                                    <div class="name">
                                        <h3 class="m-0 p-0">Wade Warren</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="post-entry-1 border-bottom">
                                    <a href="single-post.html"><img src="back/zenblog/img/post-landscape-1.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Culture</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">11 Work From Home Part-Time Jobs You
                                            Can Do Now</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                                </div>

                                <div class="post-entry-1">
                                    <div class="post-meta"><span class="date">Culture</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">5 Great Startup Tips for Female
                                            Founders</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="post-entry-1">
                                    <a href="single-post.html"><img src="back/zenblog/img/post-landscape-2.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Culture</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay
                                            Focused During Video Calls?</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused
                                    During Video Calls?</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">17 Pictures of Medium Length Hair in Layers
                                    That Will Inspire Your New Haircut</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">9 Half-up/half-down Hairstyles for Long and
                                    Medium Hair</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">Life Insurance And Pregnancy: A Working
                                    Mom’s Guide</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the
                                    Pimples Away)</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom
                                    Should Know</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Culture Category Section -->

        <!-- ======= Business Category Section ======= -->
        <section class="category-section">
            <div class="container" data-aos="fade-up">

                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h2>Business</h2>
                    <div><a href="category.html" class="more">See All Business</a></div>
                </div>

                <div class="row">
                    <div class="col-md-9 order-md-2">

                        <div class="d-lg-flex post-entry-2">
                            <a href="single-post.html" class="me-4 thumbnail d-inline-block mb-4 mb-lg-0">
                                <img src="back/zenblog/img/post-landscape-3.jpg" alt="" class="img-fluid">
                            </a>
                            <div>
                                <div class="post-meta"><span class="date">Business</span> <span
                                        class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                <h3><a href="single-post.html">What is the son of Football Coach John Gruden, Deuce
                                        Gruden doing Now?</a></h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat
                                    exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error
                                    deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?
                                </p>
                                <div class="d-flex align-items-center author">
                                    <div class="photo"><img src="back/zenblog/img/person-4.jpg" alt=""
                                            class="img-fluid"></div>
                                    <div class="name">
                                        <h3 class="m-0 p-0">Wade Warren</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="post-entry-1 border-bottom">
                                    <a href="single-post.html"><img src="back/zenblog/img/post-landscape-5.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Business</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">11 Work From Home Part-Time Jobs You
                                            Can Do Now</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                                </div>

                                <div class="post-entry-1">
                                    <div class="post-meta"><span class="date">Business</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">5 Great Startup Tips for Female
                                            Founders</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="post-entry-1">
                                    <a href="single-post.html"><img src="back/zenblog/img/post-landscape-7.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Business</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay
                                            Focused During Video Calls?</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                        Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused
                                    During Video Calls?</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">17 Pictures of Medium Length Hair in Layers
                                    That Will Inspire Your New Haircut</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">9 Half-up/half-down Hairstyles for Long and
                                    Medium Hair</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">Life Insurance And Pregnancy: A Working
                                    Mom’s Guide</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the
                                    Pimples Away)</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom
                                    Should Know</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Business Category Section -->

        <!-- ======= Lifestyle Category Section ======= -->
        <section class="category-section">
            <div class="container" data-aos="fade-up">

                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h2>Lifestyle</h2>
                    <div><a href="category.html" class="more">See All Lifestyle</a></div>
                </div>

                <div class="row g-5">
                    <div class="col-lg-4">
                        <div class="post-entry-1 lg">
                            <a href="single-post.html"><img src="back/zenblog/img/post-landscape-8.jpg"
                                    alt="" class="img-fluid"></a>
                            <div class="post-meta"><span class="date">Lifestyle</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2><a href="single-post.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                            <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero
                                temporibus repudiandae, inventore pariatur numquam cumque possimus exercitationem? Nihil
                                tempore odit ab minus eveniet praesentium, similique blanditiis molestiae ut saepe
                                perspiciatis officia nemo, eos quae cumque. Accusamus fugiat architecto rerum animi
                                atque eveniet, quo, praesentium dignissimos</p>

                            <div class="d-flex align-items-center author">
                                <div class="photo"><img src="back/zenblog/img/person-7.jpg" alt=""
                                        class="img-fluid"></div>
                                <div class="name">
                                    <h3 class="m-0 p-0">Esther Howard</h3>
                                </div>
                            </div>
                        </div>

                        <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">Lifestyle</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the
                                    Pimples Away)</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-entry-1">
                            <div class="post-meta"><span class="date">Lifestyle</span> <span
                                    class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom
                                    Should Know</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                    </div>

                    <div class="col-lg-8">
                        <div class="row g-5">
                            <div class="col-lg-4 border-start custom-border">
                                <div class="post-entry-1">
                                    <a href="single-post.html"><img src="back/zenblog/img/post-landscape-6.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2><a href="single-post.html">Let’s Get Back to Work, New York</a></h2>
                                </div>
                                <div class="post-entry-1">
                                    <a href="single-post.html"><img src="back/zenblog/img/post-landscape-5.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 17th '22</span></div>
                                    <h2><a href="single-post.html">How to Avoid Distraction and Stay Focused During
                                            Video Calls?</a></h2>
                                </div>
                                <div class="post-entry-1">
                                    <a href="single-post.html"><img src="back/zenblog/img/post-landscape-4.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Mar 15th '22</span></div>
                                    <h2><a href="single-post.html">Why Craigslist Tampa Is One of The Most Interesting
                                            Places On the Web?</a></h2>
                                </div>
                            </div>
                            <div class="col-lg-4 border-start custom-border">
                                <div class="post-entry-1">
                                    <a href="single-post.html"><img src="back/zenblog/img/post-landscape-3.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2><a href="single-post.html">6 Easy Steps To Create Your Own Cute Merch For
                                            Instagram</a></h2>
                                </div>
                                <div class="post-entry-1">
                                    <a href="single-post.html"><img src="back/zenblog/img/post-landscape-2.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Mar 1st '22</span></div>
                                    <h2><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should
                                            Know</a></h2>
                                </div>
                                <div class="post-entry-1">
                                    <a href="single-post.html"><img src="back/zenblog/img/post-landscape-1.jpg"
                                            alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2><a href="single-post.html">5 Great Startup Tips for Female Founders</a></h2>
                                </div>
                            </div>
                            <div class="col-lg-4">

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay
                                            Focused During Video Calls?</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">17 Pictures of Medium Length Hair in
                                            Layers That Will Inspire Your New Haircut</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">9 Half-up/half-down Hairstyles for
                                            Long and Medium Hair</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">Life Insurance And Pregnancy: A
                                            Working Mom’s Guide</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face
                                            (keep the Pimples Away)</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span
                                            class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working
                                            Mom Should Know</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div> <!-- End .row -->
            </div>
        </section><!-- End Lifestyle Category Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('front.layout.inc.ykfb-footer')

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="back/zenblog/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="back/zenblog/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="back/zenblog/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="back/zenblog/vendor/aos/aos.js"></script>
    <script src="back/zenblog/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="back/zenblog/js/main.js"></script>

</body>

</html>
