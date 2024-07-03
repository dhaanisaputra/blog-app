<div>
    <!-- Modal Delete-->
    <div wire:ignore.self class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Posts Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyPost">
                    <div class="modal-body">
                        <h6 style="font-size: 20px">Are you sure want to delete this post?</h6>
                    </div>
                    <div class="modal-footer mt-0">
                        <button type="button" class="btn" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="" class="form-label">Search</label>
            <input type="text" class="form-control" placeholder="Keyword..." wire:model.live='search'>
        </div>
        <div class="col-md-2 mb3">
            <label for="" class="form-label">Category</label>
            <select name="" class="form-select" wire:model.live='category'>
                <option value="">-- No Selected --</option>
                @php
                    $getSubCategory = App\Models\SubCategory::whereHas('posts')->get();
                @endphp
                @foreach ($getSubCategory as $category)
                    <option value="{{ $category->id }}">{{ $category->subcategory_name }}</option>
                @endforeach
            </select>
        </div>
        @if (auth()->user()->type == 1)
            <div class="col-md-2 mb3">
                <label for="" class="form-label">Author</label>
                <select name="" class="form-select" wire:model.live='author'>
                    <option value="">-- No Selected --</option>
                    @php
                        $getAuthor = App\Models\User::whereHas('posts')->get();
                    @endphp
                    @foreach ($getAuthor as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-md-2 mb3">
            <label for="" class="form-label">SortBy</label>
            <select class="form-select" wire:model.live='orderBy'>
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
            </select>
        </div>
    </div>

    <div class="row row-cards">
        @forelse ($posts as $post)
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <img src="{{ asset('back/dist/img/posts-upload/thumbnails/resized_' . $post->featured_image) }}"
                        alt="" class="card img-top">
                    <div class="card-body p-2">
                        <h3 class="m-0 mb-1">{{ $post->post_title }}</h3>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('author.posts.edit-post', ['post_id' => $post->id]) }}"
                            class="card-btn">Edit</a>
                        <a href="" wire:click.prevent='deletePost({{ $post->id }})' data-bs-toggle="modal"
                            data-bs-target="#deletePostModal" class="card-btn">Delete</a>
                    </div>
                </div>
            </div>
        @empty
            <span class="text-danger">No Post(s) found</span>
        @endforelse
    </div>

    <div class="d-block mt-2">
        {{ $posts->links('livewire::bootstrap') }}
    </div>
</div>
