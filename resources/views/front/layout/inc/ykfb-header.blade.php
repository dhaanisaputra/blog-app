<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/ykfb-home" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="back/zenblog/img/logo.png" alt=""> -->
            <img loading="prelaod" decoding="async" class="img-fluid"
                src="{{ url('/back/dist/img/logo-favicon/' . blogInfo()->blog_favicon) }}"
                alt="{{ blogInfo()->blog_name }}" style="max-width: 480px">
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                @php
                    $getCateg = App\Models\Category::whereHas('subcategories', function ($q) {
                        $q->whereHas('posts');
                    })->get();
                @endphp
                @foreach ($getCateg as $category)
                    <li class="dropdown">
                        <a href="#" role="button">
                            {{ $category->category_name }}
                            <i class="bi bi-chevron-down dropdown-indicator"></i>
                        </a>
                        <ul>
                            @php
                                $getSubCateg = App\Models\SubCategory::where('parent_category', $category->id)
                                    ->whereHas('posts')
                                    ->orderBy('subcategory_name', 'asc')
                                    ->get();
                            @endphp
                            @foreach ($getSubCateg as $subcategory)
                                <a class="dropdown-item"
                                    href="{{ route('category_posts', $subcategory->slug) }}">{{ $subcategory->subcategory_name }}</a>
                            @endforeach
                        </ul>
                    </li>
                @endforeach

                <li class="nav-item"> <a class="nav-link" href="{{ route('community') }}">Komunitas</a>
                </li>

                <li class="nav-item"> <a class="nav-link" href="{{ route('foty-idn') }}">FoTY</a>
                </li>

                <li><a href="{{ route('about-me') }}">About</a></li>
                {{-- <li><a href="contact.html">Contact</a></li> --}}
            </ul>
        </nav><!-- .navbar -->

        <div class="position-relative">
            <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
            <i class="bi bi-list mobile-nav-toggle"></i>

            <!-- ======= Search Form ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="{{ route('search_posts') }}" method="GET" class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text" name="query" placeholder="Search" value="{{ Request('query') }}"
                        class="form-control">
                    <button type="button" class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div>
            <!-- End Search Form -->

        </div>
    </div>

</header><!-- End Header -->
