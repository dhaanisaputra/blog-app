@extends('front.layout.ykfb-page-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Welcome To Yogyakarta Fingerboard Community')
@section('meta_tags')
    <meta name="robots" content="index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1" />
    <meta name="title" content="{{ Str::ucfirst($posts->communities_title) }}" />
    <meta name="description" content="{{ Str::ucfirst(words($posts->post_content, 120)) }}">
    <meta name="author" content="{{ $posts->author->username }}">
    <link rel="canonical" href="{{ route('read_community', $posts->post_slug) }}">
    <meta property="og:title" content="{{ Str::ucfirst($posts->communities_title) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="{{ Str::ucfirst(words($posts->post_content, 120)) }}" />
    <meta property="og:url" content="{{ route('read_community', $posts->post_slug) }}" />
    <meta property="og:image"
        content="{{ asset('back/dist/img/posts-upload/thumbnails/resized_' . $posts->featured_image) }}" />
    <meta name="twitter:domain" content="{{ Request::getHost() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ Str::ucfirst($posts->communities_title) }}" />
    <meta name="twitter:description" property="og:description" itemprop="description"
        content="{{ Str::ucfirst(words($posts->post_content, 120)) }}" />
    <meta name="twitter:image"
        content="{{ asset('back/dist/img/posts-upload/thumbnails/resized_' . $posts->featured_image) }}" />
@endsection
@section('content-ykfb')

    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content aos-init aos-animate" data-aos="fade-up">
                    <!-- ======= Single Post Content ======= -->
                    <div class="single-post">
                        <div class="post-meta"><span class="date"></span>
                            <span>{{ date_formatter($posts->created_at) }}</span>
                        </div>
                        <h1 class="mb-5">{{ $posts->communities_title }}</h1>
                        <img src="{{ asset('back/dist/img/community-upload/thumbnails/thumb_' . $posts->featured_image) }}"
                            alt="Post Thumbnail" class="img-fluid mb-1 img-thumbnail border-0"
                            style="float: left; margin: 0 25px 12px 0;">
                        <div style="text-align: justify">{!! $posts->post_content !!}</div>
                        @if ($posts->url_social_media != null)
                            <h5>Jangan lupa follow <a class="link" href="{{ $posts->url_social_media }}" target="_blank"
                                    style="text-decoration:
                                underline;">instagram</a> kami.
                            </h5>
                        @endif
                    </div>
                    <!-- End Single Post Content -->

                    {{-- <!-- ======= Comments ======= -->
            <div class="comments">
                <h5 class="comment-title py-4">2 Comments</h5>
                <div class="comment d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="avatar avatar-sm rounded-circle">
                            <img class="avatar-img" src="assets/img/person-5.jpg" alt="">
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-2 ms-sm-3">
                        <div class="comment-meta d-flex align-items-baseline">
                            <h6 class="me-2">Jordan Singer</h6>
                            <span class="text-muted">2d</span>
                        </div>
                        <div class="comment-body">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non minima ipsum at amet
                            doloremque qui magni, placeat deserunt pariatur itaque laudantium impedit aliquam
                            eligendi repellendus excepturi quibusdam nobis esse accusantium.
                        </div>

                        <div class="comment-replies bg-light p-3 mt-3 rounded">
                            <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>

                            <div class="reply d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm rounded-circle">
                                        <img class="avatar-img" src="assets/img/person-4.jpg" alt="">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2 ms-sm-3">
                                    <div class="reply-meta d-flex align-items-baseline">
                                        <h6 class="mb-0 me-2">Brandon Smith</h6>
                                        <span class="text-muted">2d</span>
                                    </div>
                                    <div class="reply-body">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    </div>
                                </div>
                            </div>
                            <div class="reply d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm rounded-circle">
                                        <img class="avatar-img" src="assets/img/person-3.jpg" alt="">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2 ms-sm-3">
                                    <div class="reply-meta d-flex align-items-baseline">
                                        <h6 class="mb-0 me-2">James Parsons</h6>
                                        <span class="text-muted">1d</span>
                                    </div>
                                    <div class="reply-body">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio dolore
                                        sed eos sapiente, praesentium.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment d-flex">
                    <div class="flex-shrink-0">
                        <div class="avatar avatar-sm rounded-circle">
                            <img class="avatar-img" src="assets/img/person-2.jpg" alt="">
                        </div>
                    </div>
                    <div class="flex-shrink-1 ms-2 ms-sm-3">
                        <div class="comment-meta d-flex">
                            <h6 class="me-2">Santiago Roberts</h6>
                            <span class="text-muted">4d</span>
                        </div>
                        <div class="comment-body">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto laborum in corrupti
                            dolorum, quas delectus nobis porro accusantium molestias sequi.
                        </div>
                    </div>
                </div>
            </div><!-- End Comments --> --}}

                    {{-- <!-- ======= Comments Form ======= -->
            <div class="row justify-content-center mt-5">

                <div class="col-lg-12">
                    <h5 class="comment-title">Leave a Comment</h5>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="comment-name">Name</label>
                            <input type="text" class="form-control" id="comment-name"
                                placeholder="Enter your name">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="comment-email">Email</label>
                            <input type="text" class="form-control" id="comment-email"
                                placeholder="Enter your email">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="comment-message">Message</label>

                            <textarea class="form-control" id="comment-message" placeholder="Enter your name" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-12">
                            <input type="submit" class="btn btn-primary" value="Post comment">
                        </div>
                    </div>
                </div>
            </div><!-- End Comments Form --> --}}

                </div>
                <div class="col-md-3">
                    <!-- ======= Sidebar ======= -->
                    <div class="aside-block">
                        <h3 class="aside-title">Latest</h3>
                        <ul class="aside-links list-unstyled">
                            @foreach (latest_community_6_posts($posts->id, 6) as $item)
                                <li><a
                                        href="{{ route('read_community', $item->post_slug) }}">{{ $item->communities_title }}</a>
                                </li>
                            @endforeach
                            {{-- <li><a href="category.html"><i class="bi bi-chevron-right"></i> Business</a></li> --}}
                        </ul>
                    </div>

                    {{-- <div class="aside-block">
                        <h3 class="aside-title">Video</h3>
                        <div class="video-post">
                            <a href="https://www.youtube.com/watch?v=AiFfDjmd0jU" class="glightbox link-video">
                                <span class="bi-play-fill"></span>
                                <img src="back/zenblog/img/post-landscape-5.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div><!-- End Video --> --}}

                    <!-- ======= Categories ======= -->
                    <div class="aside-block">
                        <h3 class="aside-title">Categories</h3>
                        <ul class="aside-links list-unstyled">
                            @include('front.layout.inc.categories_list')
                        </ul>
                    </div><!-- End Categories -->

                    <!-- ======= Tags ======= -->
                    @include('front.layout.inc.tags_list')
                    <!-- End Tags -->

                </div>
            </div>
        </div>
    </section>

@endsection
