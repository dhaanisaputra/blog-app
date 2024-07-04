@extends('front.layout.ykfb-page-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Welcome To Yogyakarta Fingerboard Community')
@section('meta_tags')
    <meta name="robots" content="index,follow" />
    <meta name="title" content="{{ blogInfo()->blog_name }}" />
    <meta name="description" content="{{ blogInfo()->blog_description }}">
    <meta name="author" content="{{ blogInfo()->blog_name }}">
    <link rel="canonical" href="{{ Request::root() }}">
    <meta property="og:title" content="{{ blogInfo()->blog_name }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ blogInfo()->blog_description }}" />
    <meta property="og:url" content="{{ Request::root() }}" />
    <meta property="og:image" content="{{ blogInfo()->blog_logo }}" />
    <meta name="twitter:domain" content="{{ Request::root() }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" property="og:title" itemprop="name" content="{{ blogInfo()->blog_name }}" />
    <meta name="twitter:description" property="og:description" itemprop="description"
        content="{{ blogInfo()->blog_description }}" />
    <meta name="twitter:image" content="{{ blogInfo()->blog_logo }}" />
@endsection
@section('content-ykfb')

    <div class="row g-5">
        <div class="col-lg-4">
            @if (single_latest_post())
                <div class="post-entry-1 lg">
                    <a href="{{ route('read_post', single_latest_post()->post_slug) }}">
                        <img src="{{ asset('back/dist/img/posts-upload/' . single_latest_post()->featured_image) }}"
                            alt="Post Thumbnail" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span>
                        <span>{{ date_formatter(single_latest_post()->created_at) }}</span>
                    </div>
                    <h2><a
                            href="{{ route('read_post', single_latest_post()->post_slug) }}">{{ single_latest_post()->post_title }}</a>
                    </h2>
                    <p class="mb-4 d-block">{!! Str::ucfirst(words(single_latest_post()->post_content, 50)) !!}</p>
                    <div class="content"> <a class="read-more-btn"
                            href="{{ route('read_post', single_latest_post()->post_slug) }}">Baca
                            Selengkapnya</a>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-8">
            <div class="row g-5">
                <div class="col-lg-4 border-start custom-border">
                    @foreach (latest_home_of_posts(3) as $item)
                        @php
                            $subcategory = App\Models\SubCategory::where('id', $item->category_id)->first();
                            // echo json_encode($subcategory);
                        @endphp
                        <div class="post-entry-1">
                            <a href="{{ route('read_post', $item->post_slug) }}"><img
                                    src="{{ asset('back/dist/img/posts-upload/thumbnails/resized_' . $item->featured_image) }}"
                                    alt="Post Thumbnail" class="img-fluid"></a>
                            <div class="post-meta"><span class="date">
                                    {{ $subcategory->subcategory_name }}
                                </span>
                                <span class="mx-1">&bullet;</span>
                                <span>{{ date_formatter($item->created_at) }}</span>
                            </div>
                            <h2><a href="{{ route('read_post', $item->post_slug) }}">{{ $item->post_title }}</a></h2>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-4 border-start custom-border">
                    @foreach (latest_home_of_posts(3) as $item)
                        @php
                            $subcategory = App\Models\SubCategory::where('id', $item->category_id)->first();
                        @endphp
                        <div class="post-entry-1">
                            <a href="{{ route('read_post', $item->post_slug) }}"><img
                                    src="{{ asset('back/dist/img/posts-upload/thumbnails/resized_' . $item->featured_image) }}"
                                    alt="Post Thumbnail" class="img-fluid"></a>
                            <div class="post-meta"><span class="date">{{ $subcategory->subcategory_name }}</span> <span
                                    class="mx-1">&bullet;</span>
                                <span>{{ date_formatter($item->created_at) }}</span>
                            </div>
                            <h2><a href="{{ route('read_post', $item->post_slug) }}">{{ $item->post_title }}</a></h2>
                        </div>
                    @endforeach
                </div>

                <!-- Trending Section -->
                @if (recomended_posts())
                    <div class="col-lg-4">

                        <div class="trending">
                            <h3>Trending</h3>
                            @foreach (recomended_of_posts(5) as $item)
                                <ul class="trending-post">
                                    <li>
                                        <a href="{{ route('read_post', $item->post_slug) }}">
                                            <span class="number">1</span>
                                            <h3>{{ $item->post_title }}</h3>
                                            {{-- <span class="author">Jane Cooper</span> --}}
                                            <span
                                                class="text-lowercase text-muted">{{ readDuration($item->post_title, $item->post_content) }}
                                                @choice('min|mins', readDuration($item->post_title, $item->post_content)) read</span>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </div>

                    </div> <!-- End Trending Section -->

                @endif
            </div>
        </div>

    </div> <!-- End .row -->

    <!-- ======= Culture Category Section ======= -->
    @php
        $getCateg = App\Models\Category::whereHas('subcategories', function ($q) {
            $q->whereHas('posts');
        })->get();
    @endphp
    @foreach ($getCateg as $category)
        <section class="category-section">
            <div class="container" data-aos="fade-up">
                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h2>{{ $category->category_name }}</h2>
                    <div><a href="category.html" class="more">See All {{ $category->category_name }}</a></div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        @php
                            $getSubCateg = App\Models\SubCategory::where('parent_category', $category->id)
                                ->whereHas('posts')
                                ->first();
                            $getPost = App\Models\Post::where('category_id', $getSubCateg->id)
                                ->orderBy('created_at', 'desc')
                                ->first();
                        @endphp
                        <div class="d-lg-flex post-entry-2">
                            <a href="{{ route('read_post', $getPost->post_slug) }}"
                                class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                                <img src="{{ asset('back/dist/img/posts-upload/thumbnails/resized_' . $getPost->featured_image) }}"
                                    alt="Post Thumbnail" class="img-fluid">
                            </a>
                            <div>
                                <div class="post-meta"><span class="date">{{ $getSubCateg->subcategory_name }}</span>
                                    <span class="mx-1">&bullet;</span>
                                    <span>{{ date_formatter($getPost->created_at) }}</span>
                                </div>
                                <h3><a href="{{ route('read_post', $getPost->post_slug) }}">{{ $getPost->post_title }}</a>
                                </h3>
                                <p>{!! Str::ucfirst(words($getPost->post_content, 50)) !!}</p>
                                <div class="d-flex align-items-center author">
                                    <div class="content"> <a class="read-more-btn"
                                            href="{{ route('read_post', $getPost->post_slug) }}">Baca
                                            Selengkapnya</a>
                                    </div>
                                    {{-- <div class="name">
                                        <h3 class="m-0 p-0">Wade Warren</h3>
                                    </div> --}}
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
                        @foreach (latest_home_6_posts($getPost->category_id) as $item)
                            <div class="post-entry-1 border-bottom">
                                <div class="post-meta"><span class="date">{{ $getSubCateg->subcategory_name }}</span>
                                    <span class="mx-1">&bullet;</span>
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
                    </div>
                </div>
            </div>
        </section>
    @endforeach
    <!-- End Culture Category Section -->
@endsection
