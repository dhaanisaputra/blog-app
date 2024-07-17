<div>
    <!-- Modal Delete-->
    <div wire:ignore.self class="modal fade" id="deleteFotyModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">FoTY Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyFoty">
                    <div class="modal-body">
                        <h6 style="font-size: 20px">Are you sure want to delete this FoTY?</h6>
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
        <div class="col-md-2 mb3"></div>
        <div class="col-md-2 mb3">
            <label for="" class="form-label">Status</label>
            <select class="form-select" wire:model.live='status'>
                <option value="">-- No Selected --</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        {{-- @if (auth()->user()->type == 1)
            <div class="col-md-2 mb3">
                <label for="" class="form-label">Author</label>
                <select name="" class="form-select" wire:model.live='author'>
                    <option value="">-- No Selected --</option>
                    @php
                        $getAuthor = App\Models\User::whereHas('communitiesposts')->get();
                    @endphp
                    @foreach ($getAuthor as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif --}}
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
                            <th>Year</th>
                            <th>Status</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($foties as $foty)
                            <tr>
                                <td>{{ $foty->name_foty }}</td>
                                <td class="text-muted">
                                    {!! Str::ucfirst(words($foty->post_content, 12)) !!}
                                </td>
                                <td class="text-muted">
                                    {!! Str::ucfirst(words($foty->url_social_media, 10)) !!}
                                </td>
                                <td class="text-muted">
                                    @php
                                        $getAuthor = App\Models\User::whereHas('fotyposts')->get();
                                    @endphp
                                    @foreach ($getAuthor as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </td>
                                <td>{{ $foty->year_foty }}</td>
                                <td class="text-muted">{{ $foty->status_foty == '0' ? 'Inactive' : 'Active' }}
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a
                                            href="{{ route('author.posts.edit-foty', ['foty_id' => $foty->id]) }}">Edit</a>
                                        &nbsp;
                                        <a href="" wire:click.prevent='deleteFoty({{ $foty->id }})'
                                            data-bs-toggle="modal" data-bs-target="#deleteFotyModal">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td><span class="text-danger">No FoTY found</span></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-block mt-2">
            {{ $foties->links('livewire::bootstrap') }}
        </div>
    </div>
</div>
