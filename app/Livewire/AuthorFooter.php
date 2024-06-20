<?php

namespace App\Livewire;

use App\Models\Settings;
use Livewire\Component;

class AuthorFooter extends Component
{
    public $settings;

    protected $listeners = [
        'updateAuthorFooter' => '$refresh'
    ];

    public function mount()
    {
        $this->settings = Settings::find(1);
    }

    public function render()
    {
        return view('livewire.author-footer');
    }
}
