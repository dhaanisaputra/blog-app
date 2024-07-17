<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-content">
        <div class="container">

            <div class="row g-5">
                <div class="col-6 col-lg-4">
                    <h3 class="footer-heading">About YkFb Blog</h3>
                    <p class="mb-4 d-block">{{ blogInfo()->blog_description }}</p>
                    {{-- <p><a href="about.html" class="footer-link-more">Learn More</a></p> --}}
                    <div>
                        <p style="text-align: left">Info meetup Yogyakarta Fingerboard Community</p>
                        <p style="text-align: left">Lokasi : Barsa City Foodtruck (dekat Flyover Janti), Ngentak,
                            Caturtunggal, Kec. Depok, Kab.
                            Sleman, D.I. Yogyakarta </p>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    {{-- <h3 class="footer-heading">Navigation</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="index.html"><i class="bi bi-chevron-right"></i> Home</a></li>
                        <li><a href="index.html"><i class="bi bi-chevron-right"></i> Blog</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Categories</a></li>
                        <li><a href="single-post.html"><i class="bi bi-chevron-right"></i> Single Post</a></li>
                        <li><a href="about.html"><i class="bi bi-chevron-right"></i> About us</a></li>
                        <li><a href="contact.html"><i class="bi bi-chevron-right"></i> Contact</a></li>
                    </ul> --}}
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Categories</h3>
                    <ul class="footer-links list-unstyled">
                        @include('front.layout.inc.categories_list')
                    </ul>
                </div>

                @if (recomended_posts())
                    <div class="col-lg-4">
                        <h3 class="footer-heading">Recent Posts</h3>

                        <ul class="footer-links footer-blog-entry list-unstyled">
                            <li>
                                @foreach (recomended_posts() as $item)
                                    <a href="{{ route('read_post', $item->post_slug) }}"
                                        class="d-flex align-items-center mt-2">
                                        <img src="{{ asset('back/dist/img/posts-upload/thumbnails/thumb_' . $item->featured_image) }}"
                                            alt="Post Thumbnail" class="img-fluid me-3">
                                        <div>
                                            <div class="post-meta d-block"><span
                                                    class="date">{!! Str::ucfirst(words($item->post_title, 2)) !!}</span> <span
                                                    class="mx-1">&bullet;</span>
                                                <span>{{ date_formatter($item->created_at) }}</span>
                                            </div>
                                            <span>{!! Str::ucfirst(words($item->post_content, 5)) !!}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </li>
                        </ul>

                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="footer-legal">
        <div class="container">

            <div class="row justify-content-between">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="copyright">
                        © Copyright <strong><span>YkFB</span></strong>. All Rights Reserved
                    </div>

                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
                        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
                        <script>
                            document.write(new Date().getFullYear())
                        </script> | Designed &amp; Developed By <a
                            href="/ykfb-home">{{ blogInfo()->blog_name }}</a>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
                        @php
                            $getSocmed = App\Models\BlogSocialMedia::all();
                        @endphp
                        @foreach ($getSocmed as $item)
                            @if ($item->bsm_facebook == null)
                                <a data-toggle="tooltip" data-placement="top" title="Not Ready!" class="facebook"
                                    target="" rel="noopener noreferrer" aria-label="Facebook"><i
                                        class="bi bi-facebook"></i></a>
                            @else
                                <a href="{{ $item->bsm_facebook }}" class="facebook" target="_blank"
                                    rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if ($item->bsm_instagram == null)
                                <a data-toggle="tooltip" data-placement="top" title="Not Ready!" class="instagram"
                                    target="" rel="noopener noreferrer" aria-label="Instagram"><i
                                        class="bi bi-instagram"></i></a>
                            @else
                                <a href="{{ $item->bsm_instagram }}" class="instagram" target="_blank"
                                    rel="noopener noreferrer" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                            @endif
                            @if ($item->bsm_youtube == null)
                                <a data-toggle="tooltip" data-placement="top" title="Not Ready!" class="youtube"
                                    target="" rel="noopener noreferrer" aria-label="Youtube"><i
                                        class="bi bi-youtube"></i></a>
                            @else
                                <a href="{{ $item->bsm_youtube }}" class="youtube" target="_blank"
                                    rel="noopener noreferrer" aria-label="Youtube"><i class="bi bi-youtube"></i></a>
                            @endif
                        @endforeach
                        {{-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> --}}
                    </div>

                </div>

            </div>

        </div>
    </div>

</footer>

@push('scripts')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
