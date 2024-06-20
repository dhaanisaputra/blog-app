<?php

namespace App\Livewire;

use App\Models\BlogSocialMedia;
use Livewire\Component;

class AuthorBlogSocialMediaForm extends Component
{
    public $blog_social_media;

    public $instagram_url, $facebook_url, $youtube_url;

    public function mount()
    {
        $this->blog_social_media = BlogSocialMedia::find(1);
        $this->instagram_url = $this->blog_social_media->bsm_instagram;
        $this->facebook_url = $this->blog_social_media->bsm_facebook;
        $this->youtube_url = $this->blog_social_media->bsm_youtube;
    }

    public function updateBlogSocialMedia()
    {
        $this->validate([
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'youtube_url' => 'nullable|url'
        ]);

        $update = $this->blog_social_media->update([
            'bsm_instagram' => $this->instagram_url,
            'bsm_facebook' => $this->facebook_url,
            'bsm_youtube' => $this->youtube_url,
        ]);

        if ($update) {
            $this->showToastr('Social Media Info have been updated', 'success');
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
        return view('livewire.author-blog-social-media-form');
    }
}
