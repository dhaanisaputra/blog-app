<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class AllPosts extends Component
{
    use WithPagination;
    public $perPage = 4;
    public $search = null;
    public $author = null;
    public $category = null;
    public $orderBy = null;
    public $selected_post_id;

    public function mount()
    {
        $this->resetPage();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingCategory()
    {
        $this->resetPage();
    }
    public function updatingAuthor()
    {
        $this->resetPage();
    }
    public function deletePost($id)
    {
        $this->selected_post_id = $id;
    }


    public function destroyPost()
    {
        $post = Post::find($this->selected_post_id);
        $path = 'back/dist/img/posts-upload/';
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
            $this->showToastr('Post has been deleted', 'success');
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
        return view('livewire.all-posts', [
            'posts' => auth()->user()->type == 1 ?
                Post::search(trim($this->search))
                ->when($this->category, function ($query) {
                    $query->where('category_id', $this->category);
                })
                ->when($this->author, function ($query) {
                    $query->where('author_id', $this->author);
                })
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage) :
                Post::search(trim($this->search))
                ->when($this->category, function ($query) {
                    $query->where('category_id', $this->category);
                })
                ->when(true, function ($query) {
                    $query->where('author_id', auth()->id());
                })
                // ->when('author_id', auth()->id())
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage)
        ]);
    }
}
