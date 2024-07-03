<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Community;
use Livewire\WithPagination;

class AllCommunity extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = null;
    public $author = null;
    public $category = null;
    public $orderBy = null;
    public $selected_post_id;

    public function mount()
    {
        $this->resetPage();
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
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perPage)
        ]);
    }
}
