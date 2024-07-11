@extends('front.layout.ykfb-page-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Welcome To Yogyakarta Fingerboard Community')
@section('meta_tags')
    <meta name="robots" content="index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1" />
    <meta name="title" content="{{ Str::ucfirst($posts->post_title) }}" />
    <meta name="description" content="{{ Str::ucfirst(words($posts->post_content, 120)) }}">
    <meta name="author" content="{{ $posts->author->username }}">
    <link rel="canonical" href="{{ route('read_post', $posts->post_slug) }}">
    <meta property="og:title" content="{{ Str::ucfirst($posts->post_title) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="{{ Str::ucfirst(words($posts->post_content, 120)) }}" />
    <meta property="og:url" content="{{ route('read_post', $posts->post_slug) }}" />
    <meta property="og:image"
        content="{{ asset('back/dist/img/posts-upload/thumbnails/resized_' . $posts->featured_image) }}" />
    <meta name="twitter:domain" content="{{ Request::getHost() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ Str::ucfirst($posts->post_title) }}" />
    <meta name="twitter:description" property="og:description" itemprop="description"
        content="{{ Str::ucfirst(words($posts->post_content, 120)) }}" />
    <meta name="twitter:image"
        content="{{ asset('back/dist/img/posts-upload/thumbnails/resized_' . $posts->featured_image) }}" />
@endsection
@section('content-ykfb')

    @php
        $subcategory = App\Models\SubCategory::where('id', $posts->category_id)->first();
    @endphp
    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content aos-init aos-animate" data-aos="fade-up">
                    @php
                        update_view_counter($posts->post_slug);
                    @endphp
                    <!-- ======= Single Post Content ======= -->
                    <div class="single-post">
                        <div class="post-meta"><span class="date">{{ $subcategory->subcategory_name }}</span> <span
                                class="mx-1">•</span>
                            <span>{{ date_formatter($posts->created_at) }}</span>
                        </div>
                        <h1 class="mb-5">{{ $posts->post_title }}</h1>
                        <img src="{{ asset('back/dist/img/posts-upload/thumbnails/resized_' . $posts->featured_image) }}"
                            alt="Post Thumbnail" class="img-fluid mb-4">
                        <p>{!! $posts->post_content !!}</p>

                        @if ($posts->post_tags)
                            @php
                                $tagsStr = $posts->post_tags;
                                $tagsArray = explode(',', $tagsStr);
                            @endphp
                            <div class="tags-container mt-4">
                                <ul class="aside-tags list-unstyled">
                                    @foreach ($tagsArray as $tag)
                                        <li><a href="{{ route('tag_posts', $tag) }}">#{{ $tag }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
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

                        <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-popular" type="button" role="tab"
                                    aria-controls="pills-popular" aria-selected="true">Recommended</button>
                            </li>
                            {{-- <li class="nav-item" role="presentation"> --}}
                            {{-- <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-trending" type="button" role="tab"
                                    aria-controls="pills-trending" aria-selected="false" tabindex="-1">Trending</button> --}}
                            {{-- </li> --}}
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-latest" type="button" role="tab"
                                    aria-controls="pills-latest" aria-selected="false" tabindex="-1">Latest</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">

                            <!-- Recommended -->
                            <div class="tab-pane fade active show" id="pills-popular" role="tabpanel"
                                aria-labelledby="pills-popular-tab">
                                @foreach (recomended_of_posts(6) as $item)
                                    @php
                                        $subcategory = App\Models\SubCategory::where('id', $item->category_id)
                                            ->whereHas('posts')
                                            ->first();
                                    @endphp
                                    <div class="post-entry-1 border-bottom">
                                        <div class="post-meta"><span
                                                class="date">{{ $subcategory->subcategory_name }}</span> <span
                                                class="mx-1">•</span>
                                            <span>{{ date_formatter($item->created_at) }}</span>
                                        </div>
                                        <h2 class="mb-2"><a
                                                href="{{ route('read_post', $item->post_slug) }}">{{ $item->post_title }}</a>
                                        </h2>
                                        @php
                                            $getAuthor = App\Models\User::where('id', $item->author_id)->first();
                                        @endphp
                                        <span class="author mb-3 d-block">{{ $getAuthor->name }}</span>
                                    </div>
                                @endforeach
                            </div> <!-- End Recommended -->

                            <!-- Latest -->
                            @php
                                $getSubCateg = App\Models\SubCategory::where('id', $posts->category_id)
                                    ->whereHas('posts')
                                    ->first();
                            @endphp
                            <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                                @foreach (latest_home_6_posts_with_except_id($getSubCateg->id, $posts->id) as $item)
                                    <div class="post-entry-1 border-bottom">
                                        <div class="post-meta"><span
                                                class="date">{{ $getSubCateg->subcategory_name }}</span> <span
                                                class="mx-1">•</span>
                                            <span>{{ date_formatter($item->created_at) }}</span>
                                        </div>
                                        <h2 class="mb-2"><a
                                                href="{{ route('read_post', $item->post_slug) }}">{{ $item->post_title }}</a>
                                        </h2>
                                        @php
                                            $getAuthor = App\Models\User::where('id', $item->author_id)->first();
                                        @endphp
                                        <span class="author mb-3 d-block">{{ $getAuthor->name }}</span>
                                    </div>
                                @endforeach
                            </div> <!-- End Latest -->

                        </div>
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
