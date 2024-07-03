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

    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Social Media Url</th>
                            <th>Author</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comunities as $community)
                            <tr>
                                <td>{{ $community->communities_title }}</td>
                                <td class="text-muted">
                                    {!! Str::ucfirst(words($community->post_content, 12)) !!}
                                </td>
                                <td class="text-muted">
                                    {!! Str::ucfirst(words($community->url_social_media, 10)) !!}
                                </td>
                                <td class="text-muted">
                                    User
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="#">Edit</a> &nbsp;
                                        <a href="#">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td><span class="text-danger">No Community found</span></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-block mt-2">
            {{ $comunities->links('livewire::bootstrap') }}
        </div>
    </div>
</div>
