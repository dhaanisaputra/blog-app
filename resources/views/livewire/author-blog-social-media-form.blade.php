<div>
    <form method="POST" wire:submit.prevent='updateBlogSocialMedia()'>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Instagram</label>
                    <input type="text" class="form-control" placeholder="Your Instagram Url" wire:model='instagram_url'>
                    <span class="text-danger">@error('instagram_url'){{$message}}@enderror</span>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Facebook</label>
                    <input type="text" class="form-control" placeholder="Your Facebook Url" wire:model='facebook_url'>
                    <span class="text-danger">@error('facebook_url'){{$message}}@enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Youtube</label>
                    <input type="text" class="form-control" placeholder="Your Youtube Url" wire:model='youtube_url'>
                    <span class="text-danger">@error('youtube_url'){{$message}}@enderror</span>
                </div>
            </div> --}}
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
