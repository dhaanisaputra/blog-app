@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Add New Post')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
                Edit Post
            </h2>
        </div>
      </div>
    </div>
</div>
<form action="{{route('author.posts.update-post',['post_id'=>Request('post_id')])}}" method="POST" id='editPostForm' enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                @if (session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
                @endif
                <div class="col-md-9">
                    <div class="mb-3">
                        <label class="form-label">Post Title</label>
                        <input type="text" class="form-control" name="post_title" placeholder="Enter post title" value="{{ $post->post_title }}">
                        <span class="text-danger">@error('post_title'){{$message}}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Post content</label>
                        <textarea class="ckeditor form-control" id="desc_post" name="post_content" rows="6" placeholder="Content..">{!! $post->post_content !!}</textarea>
                        <span class="text-danger">@error('post_content'){{$message}}@enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <div class="form-label">Post Category</div>
                        <select class="form-select" name="post_category" wire:model="post_category">
                        <option value="">No Selected</option>
                        @php
                                $getCategory = App\Models\SubCategory::all();
                        @endphp
                        @foreach ($getCategory as $categories)
                            <option value="{{$categories->id}}" {{ $post->category_id == $categories->id ? 'selected' : '' }}>{{$categories->subcategory_name}}</option>
                        @endforeach
                        </select>
                        <span class="text-danger">@error('post_category'){{$message}}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Featured Image</div>
                        <input type="file" name="featured_image" id="featured_image" class="form-control" onchange="previewImage(event)">
                        <span class="text-danger">@error('featured_image'){{$message}}@enderror</span>
                        <div class="image-preview" id="imagePreview">
                            <img src="{{asset('back/dist/img/posts-upload/thumbnails/resized_'.$post->featured_image)}}" alt="" class="img-fluid mt-2 img-thumbnail" id="imagePreviewImg">
                        </div>
                    </div>
                    {{-- @livewire('upload-images-component') --}}
                    <div class="mb-3">
                        <label for="" class="form-label">Post Tags</label>
                        <input type="text" class="form-control" name="post_tags" value="{{ $post->post_tags}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Post</button>
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
        reader.onload = function(){
            if(reader.readyState == 2){
                imagePreviewImg.src = reader.result;
                imagePreviewImg.style.display = 'block';
                imagePreview.querySelector('span').style.display = 'none';
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush

