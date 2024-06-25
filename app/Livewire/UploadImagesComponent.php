<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadImagesComponent extends Component
{
    use WithFileUploads;
    public $featured_image;

    public function mount()
    {
    }

    public function uploadImage()
    {
        $this->validate([
            'featured_image' => 'required',
        ]);
    }

    public function render()
    {
        return view('livewire.upload-images-component');
    }
}
