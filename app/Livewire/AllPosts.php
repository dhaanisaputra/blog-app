<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;
    public $perPage = 4;
    public $search = null;
    public $author = null;
    public $category = null;
    public $orderBy = null;

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
                ->when('author_id', auth()->id())
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage)
        ]);
    }
}
