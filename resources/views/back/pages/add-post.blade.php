@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Add New Post')
@section('content')

<div class="page-header d-print-none">
    {{-- <div class="container-xl"> --}}
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Add New Post
                </h2>
            </div>
        </div>
    {{-- </div> --}}
</div>
<form action="{{route('author.posts.create')}}" method="POST" id='addPostForm' enctype="multipart/form-data">
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
                        <input type="text" class="form-control" name="post_title" placeholder="Enter post title">
                        {{-- <span class="text-danger error-text post_title_error"></span> --}}
                        <span class="text-danger">@error('post_title'){{$message}}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Post content</label>
                        <textarea class="ckeditor form-control" id="desc_post" name="post_content" rows="6" placeholder="Content.."></textarea>
                        {{-- <span class="text-danger error-text post_content_error"></span> --}}
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
                            <option value="{{$categories->id}}">{{$categories->subcategory_name}}</option>
                        @endforeach
                        </select>
                        {{-- <span class="text-danger error-text post_category_error"></span> --}}
                        <span class="text-danger">@error('post_category'){{$message}}@enderror</span>
                    </div>
                    {{-- <div class="mb-3">
                        <div class="form-label">Featured Image</div>
                        <input id="featured_image" type="file" class="form-control" name="featured_image" >
                        <img src="#" id="category-img-tag" width="200px" />   <!--for preview purpose -->
                    </div> --}}
                    {{-- <div class="image_holder mb-2" style="max-width:250px">
                        <img src="" alt="" class="img-thumbnail" id="image-previewer" data-ijabo-default-img=''>
                    </div> --}}
                    <div class="mb-3">
                        <div class="form-label">Featured Image</div>
                        <input type="file" name="featured_image" id="featured_image" class="form-control" onchange="previewImage(event)">
                        <span class="text-danger">@error('featured_image'){{$message}}@enderror</span>
                        <div class="image-preview" id="imagePreview">
                            <img src="" alt="" class="img-fluid mt-2 img-thumbnail" id="imagePreviewImg">
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="image-preview" id="imagePreview">
                            <span>Image Preview</span>
                            <img src="" alt="Image Preview" class="img-fluid" id="imagePreviewImg">
                        </div>
                    </div> --}}
                    {{-- @livewire('upload-images-component') --}}
                    <div class="mb-3">
                        <label for="" class="form-label">Post Tags</label>
                        <input type="text" class="form-control" name="post_tags">
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
        reader.onload = function(){
            if(reader.readyState == 2){
                imagePreviewImg.src = reader.result;
                imagePreviewImg.style.display = 'block';
                imagePreview.querySelector('span').style.display = 'none';
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    // function readURL(input) {
    // if (input.target.files[0]) {
    //     var reader = new FileReader();

    //     reader.onload = function (e) {
    //         $('#category-img-tag').attr('src', e.target.result);
    //     }

    //     reader.readAsDataURL(input.target.files[0]);
    //     }
    // }

    // $("#featured_image").change(function(){
    //     readURL(this);
    // });

    // $(function() {
    //     $('input[type="file"][name="featured_image"]').ijaboViewer({
    //         preview:'#image-previewer',
    //         imageShape:'rectangular',
    //         allowedExtensions:['jpg','img','png'],
    //         onErrorShape:function(message,element){
    //             alert(message);
    //         },
    //         onInvalidType:function(message,element){
    //             alert(message);
    //         }
    //     });
    // });

    // $('form#addPostForm').on('submit', function(e){
    //     e.preventDefault();
    //     toastr.remove();
    //     var form = this;
    //     var fromdata = new FormData(form);

    //     $.ajax({
    //         url:$(form).attr('action'),
    //         method:$(form).attr('method'),
    //         data:fromdata,
    //         processData:false,
    //         beforeSend:function() {
    //             $(form).find('span.error-text').text('');
    //         },
    //         success:function(response){
    //             toastr.remove();
    //             if(response.code == 1){
    //                 $(form)[0].reset();
    //                 $('div.image_holder').html('');
    //                 toastr.success(response.msg);
    //             } else {
    //                 toastr.error(response.msg);
    //             }
    //         },
    //         error:function(response){
    //             toastr.remove();
    //             $.each(response.responseJSON.errors, function(prefix, val){
    //                 $(form).find('span.'+prefix+'_error').text(val[0]);
    //             });
    //         }
    //     });
    // });

</script>
@endpush

