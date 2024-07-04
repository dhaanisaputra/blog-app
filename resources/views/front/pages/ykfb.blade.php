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
                <div class="col-lg-4">

                    <div class="trending">
                        <h3>Trending</h3>
                        <ul class="trending-post">
                            <li>
                                <a href="single-post.html">
                                    <span class="number">1</span>
                                    <h3>The Best Homemade Masks for Face (keep the Pimples Away)</h3>
                                    <span class="author">Jane Cooper</span>
                                </a>
                            </li>
                            <li>
                                <a href="single-post.html">
                                    <span class="number">2</span>
                                    <h3>17 Pictures of Medium Length Hair in Layers That Will Inspire Your
                                        New Haircut</h3>
                                    <span class="author">Wade Warren</span>
                                </a>
                            </li>
                            <li>
                                <a href="single-post.html">
                                    <span class="number">3</span>
                                    <h3>13 Amazing Poems from Shel Silverstein with Valuable Life Lessons
                                    </h3>
                                    <span class="author">Esther Howard</span>
                                </a>
                            </li>
                            <li>
                                <a href="single-post.html">
                                    <span class="number">4</span>
                                    <h3>9 Half-up/half-down Hairstyles for Long and Medium Hair</h3>
                                    <span class="author">Cameron Williamson</span>
                                </a>
                            </li>
                            <li>
                                <a href="single-post.html">
                                    <span class="number">5</span>
                                    <h3>Life Insurance And Pregnancy: A Working Mom’s Guide</h3>
                                    <span class="author">Jenny Wilson</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div> <!-- End Trending Section -->
            </div>
        </div>

    </div> <!-- End .row -->
@endsection
