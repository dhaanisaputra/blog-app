<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Nette\Utils\Random;

class Authors extends Component
{

    public $name, $email, $username, $authorType, $direct_publisher;
    public $listeners = [
        'resetForms'
    ];

    public function resetForms()
    {
        $this->name = $this->email = $this->username = $this->authorType = $this->direct_publisher = null;
        $this->resetErrorBag();
    }

    public function addAuthor()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:6|max:20',
            'authorType' => 'required',
            'direct_publisher' => 'required',
        ], [
            'authorType.required' => 'Choose author type',
            'direct_publisher.required' => 'Specify author publication access'
        ]);

        if ($this->isOnline()) {
            $default_password = Random::generate(8);
            $author = new User();
            $author->name = $this->name;
            $author->email = $this->email;
            $author->username = $this->username;
            $author->password = Hash::make($default_password);
            $author->type = $this->authorType;
            $author->direct_publish = $this->direct_publisher;
            $saved = $author->save();

            $data = array(
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $default_password,
                'url' => route('author.profile'),
            );

            $author_email = $this->email;
            $author_name = $this->name;

            if ($saved) {

                Mail::send('new-author-email-template', $data, function ($message) use ($author_email, $author_name) {
                    $message->from('noreply@example.com', 'YkfbBlog');
                    $message->to($author_email, $author_name)
                        ->subject('Account Author');
                });

                $this->showToastr('New author has been added', 'success');
                $this->name = $this->email = $this->username = $this->authorType = $this->direct_publisher = null;
                $this->dispatch('hide_add_author_modal');
            } else {
                $this->showToastr('Something went wrong', 'error');
            }
        } else {
            $this->showToastr('You are offline, check your connection', 'error');
        }
    }

    public function showToastr($message, $type)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function isOnline($site = "https://www.youtube.com/")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }

    public function render()
    {
        return view('livewire.authors', [
            'authors' => User::where('id', '!=', auth()->id())->get(),
        ]);
    }
}
