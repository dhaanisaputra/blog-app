<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Community;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class AllCommunity extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = null;
    public $author = null;
    public $category = null;
    public $orderBy = null;
    public $status = null;
    public $selected_community_id;

    public function mount()
    {
        $this->resetPage();
    }

    public function deleteCommunity($id)
    {
        $this->selected_community_id = $id;
    }

    public function destroyCommunity()
    {
        $post = Community::find($this->selected_community_id);
        $path = 'back/dist/img/community-upload/';
        $featured_image = $post->featured_image;

        if ($featured_image != null && File::exists(public_path($path . $featured_image))) {
            // -- delete image resized --
            if (File::exists(public_path($path . 'thumbnails/resized_' . $featured_image))) {
                File::delete($path . 'thumbnails/resized_' . $featured_image);
            }
            // -- delete image thumbnails --
            if (File::exists(public_path($path . 'thumbnails/thumb_' . $featured_image))) {
                File::delete($path . 'thumbnails/thumb_' . $featured_image);
            }
            // -- delete image posts --
            File::delete($path . $featured_image);
        }

        $delete_post = $post->delete();
        if ($delete_post) {
            $this->showToastr('Community has been deleted', 'success');
            $this->dispatch('close-modal');
        } else {
            $this->showToastr('Something went wrong', 'error');
        }
    }

    public function showToastr($message, $type)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function render()
    {
        // return view('livewire.all-community');
        return view('livewire.all-community', [
            // 'comunities' => Community::orderBy('communities_title', 'asc')->paginate($this->perPage),
            'comunities' => Community::search(trim($this->search))
                ->when($this->author, function ($query) {
                    $query->where('author_id', $this->author);
                })
                ->when(isset($this->status), function ($query) {
                    $query->where('status_community', $this->status);
                })
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('communities_title', $this->orderBy);
                })
                ->paginate($this->perPage)
        ]);
    }
}
