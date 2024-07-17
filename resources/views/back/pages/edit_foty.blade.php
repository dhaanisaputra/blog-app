@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Edit FoTY')
@section('content')

    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Edit FoTY
                </h2>
            </div>
        </div>
    </div>
    <form action="{{ route('author.posts.update-foty', ['foty_id' => Request('foty_id')]) }}" method="POST"
        id='editPostFotyForm' enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Name Fingerboarder of The Year</label>
                            <input type="text" class="form-control" name="name_foty" placeholder="Enter name"
                                value="{{ $post->name_foty }}">
                            <span class="text-danger">
                                @error('name_foty')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">FoTY Description</label>
                            <textarea class="ckeditor form-control" id="desc_post" name="post_content" rows="6" placeholder="Content..">{!! $post->post_content !!}</textarea>
                            <span class="text-danger">
                                @error('post_content')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Year</label>
                            <select id="yearDropdown" name="year_foty" class="form-select"></select>
                            {{-- <option value="{{ $post->year_foty }}" selected>{{ $post->year_foty }}</option> --}}
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Url Social Media</label>
                            <input type="text" class="form-control" name="url_social_media" placeholder="Enter url"
                                value="{{ $post->url_social_media }}">
                            <span class="text-danger">
                                @error('url_social_media')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <div class="form-label">Featured Image</div>
                            <input type="file" name="featured_image" id="featured_image" class="form-control"
                                onchange="previewImage(event)">
                            <span class="text-danger">
                                @error('featured_image')
                                    {{ $message }}
                                @enderror
                            </span>
                            <div class="image-preview" id="imagePreview">
                                <img src="{{ asset('back/dist/img/foty-upload/thumbnails/resized_' . $post->featured_image) }}"
                                    alt="" class="img-fluid mt-2 img-thumbnail" id="imagePreviewImg">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Status</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status_foty" value="1"
                                    {{ $post->status_foty == '1' ? 'checked' : '' }}>
                                <span class="form-check-label">Is Active?</span>
                            </label>
                            <span class="text-danger">
                                @error('status_foty')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Post</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
    {{-- --- ckeditor --- --}}
    <script>
        // CKEDITOR.replace( 'desc_post' );
        ClassicEditor
            .create(document.querySelector('#desc_post'))
            .catch(error => {
                console.error(error);
            });
    </script>
    {{-- -- preview image -- --}}
    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            const imagePreviewImg = document.getElementById('imagePreviewImg');
            const reader = new FileReader();
            reader.onload = function() {
                if (reader.readyState == 2) {
                    imagePreviewImg.src = reader.result;
                    imagePreviewImg.style.display = 'block';
                    imagePreview.querySelector('span').style.display = 'none';
                }
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script>
        // Get the current year
        const currentYear = new Date().getFullYear();

        // Define the range
        const startYear = 2020;
        const endYear = currentYear + 1;

        // Get the dropdown element
        const dropdown = document.getElementById('yearDropdown');

        // The year from the database
        const selectedYear = {{ $post->year_foty }};

        // Populate the dropdown with the year range
        for (let year = startYear; year <= endYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.text = year;
            if (year === selectedYear) {
                option.selected = true; // Set the current year as selected
            }
            dropdown.add(option);
        }
    </script>
@endpush
