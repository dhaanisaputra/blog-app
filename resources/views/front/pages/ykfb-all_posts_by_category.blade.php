@extends('front.layout.ykfb-page-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Welcome To Yogyakarta Fingerboard Community')
@section('content-ykfb')

    {{-- <section> --}}
    <div class="container">
        <div class="row">

            <div class="col-md-9 aos-init aos-animate" data-aos="fade-up">
                <h3 class="category-title">{{ $pageTitle }}</h3>
                @forelse ($posts as $item)
                    @php
                        $getSubCateg = App\Models\SubCategory::where('id', $item->category_id)
                            ->whereHas('posts')
                            ->first();
                    @endphp
                    <div class="d-md-flex post-entry-2 half">
                        <a href="{{ route('read_post', $item->post_slug) }}" class="me-4 thumbnail">
                            <img src="{{ asset('back/dist/img/posts-upload/thumbnails/resized_' . $item->featured_image) }}"
                                alt="" class="img-fluid">
                        </a>
                        <div>
                            <div class="post-meta"><span class="date">{{ $getSubCateg->subcategory_name }}</span> <span
                                    class="mx-1">•</span>
                                <span>{{ date_formatter($item->created_at) }}</span>
                            </div>
                            <h3><a href="{{ route('read_post', $item->post_slug) }}">{{ $item->post_title }}</a></h3>
                            <p>{!! Str::ucfirst(words($item->post_content, 40)) !!}</p>
                            <div class="d-flex align-items-center author">
                                <div class="name">
                                    @php
                                        $getAuthor = App\Models\User::where('id', $item->author_id)->first();
                                    @endphp
                                    <h3 class="m-0 p-0">{{ $getAuthor->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <span class="text-danger">No Posts found in this category.</span>
                @endforelse

                {{-- {{ $posts->appends(request()->input())->links('ykfb-custom_pagination') }} --}}

            </div>

            <div class="col-md-3">
                <!-- ======= Sidebar ======= -->
                <div class="aside-block">

                    <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular"
                                aria-selected="true">Recommended</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest"
                                aria-selected="false" tabindex="-1">Latest</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">

                        <!-- Recommended -->
                        <div class="tab-pane fade active show" id="pills-popular" role="tabpanel"
                            aria-labelledby="pills-popular-tab">
                            @foreach (random_home_posts_per_category($category, 6) as $item)
                                @php
                                    $subcategory = App\Models\SubCategory::where('id', $item->category_id)
                                        ->whereHas('posts')
                                        ->first();
                                @endphp
                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">
                                            {{-- {{ $subcategory->subcategory_name }} --}}
                                        </span>
                                        <span class="mx-1">•</span>
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
                        <!-- End Recommended -->

                        <!-- Latest -->
                        {{-- @php
                            $getSubCateg = App\Models\SubCategory::where(
                                'subcategory_name',
                                $category->subcategory_name,
                            )
                                ->whereHas('posts')
                                ->first();
                        @endphp --}}
                        <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                            @foreach (latest_home_posts_per_category_skip_1($category, 6) as $item)
                                <div class="post-entry-1 border-bottom">
                                    <div class="post-meta"><span class="date">{{ $getSubCateg->subcategory_name }}</span>
                                        <span class="mx-1">•</span>
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
                        <!-- End Latest -->

                    </div>
                </div>

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
    {{-- </section> --}}

@endsection
