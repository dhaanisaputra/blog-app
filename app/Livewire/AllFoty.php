<?php

namespace App\Livewire;

use App\Models\Foty;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class AllFoty extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = null;
    public $author = null;
    public $orderBy = null;
    public $status = null;
    public $selected_foty_id;

    public function mount()
    {
        $this->resetPage();
    }

    public function deleteFoty($id)
    {
        $this->selected_foty_id = $id;
    }

    public function destroyFoty()
    {
        $post = Foty::find($this->selected_foty_id);
        $path = 'back/dist/img/foty-upload/';
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
            $this->showToastr('Foty has been deleted', 'success');
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
        // return view('livewire.all-foty');
        return view('livewire.all-foty', [
            'foties' => Foty::search(trim($this->search))
                ->when($this->author, function ($query) {
                    $query->where('author_id', $this->author);
                })
                ->when(isset($this->status), function ($query) {
                    $query->where('status_foty', $this->status);
                })
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('name_foty', $this->orderBy);
                })
                ->paginate($this->perPage)
        ]);
    }
}
