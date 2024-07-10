@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Add New Community')
@section('content')

    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Add New Community
                </h2>
            </div>
        </div>
    </div>
    <form action="{{ route('author.posts.create-community') }}" method="POST" id='addPostCommunitiyForm'
        enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label class="form-label">Community Title</label>
                            <input type="text" class="form-control" name="communities_title"
                                placeholder="Enter post title">
                            <span class="text-danger">
                                @error('communities_title')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Community Description</label>
                            <textarea class="ckeditor form-control" id="desc_post" name="post_content" rows="6" placeholder="Content.."></textarea>
                            <span class="text-danger">
                                @error('post_content')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Url Social Media</label>
                            <input type="text" class="form-control" name="url_social_media" placeholder="Enter url">
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
                                <img src="" alt="" class="img-fluid mt-2 img-thumbnail"
                                    id="imagePreviewImg">
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <div class="form-label">Is Active?</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_community" value="0">
                                    <span class="form-check-label">No</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_community" value="1">
                                    <span class="form-check-label">Yes</span>
                                </label>
                            </div>
                            <span class="text-danger">
                                @error('status_community')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div> --}}
                        <div class="mb-3">
                            <div class="form-label">Status</div>
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status_community" value="1">
                                <span class="form-check-label">Is Active?</span>
                            </label>
                            <span class="text-danger">
                                @error('status_community')
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
@endpush
