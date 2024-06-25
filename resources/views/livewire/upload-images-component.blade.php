<div>
    <form wire:submit.prevent="uploadImage">
        <div class="mb-3">
            <div class="form-label">Featured Image</div>
            <input type="file" class="form-control" name="featured_image" wire:model="featured_image" style="padding: 5px 5px;">

            <span class="text-danger">@error('featured_image'){{$message}}@enderror</span>

            <div wire:loading wire:target="featured_image" wire:key="featured_image"><i class="fa fa-spinner fa-spin mt-4 ml-2"></i>
                Uploading
            </div>

            {{-- imagepreview --}}
            @if ($featured_image)
                <img src="{{ $featured_image->temporaryUrl()}}" width="200" alt="" class="mt-2 img-thumbnail">
            @endif()

        </div>
    </form>
</div>
