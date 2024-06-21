<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Nette\Utils\Random;

class Authors extends Component
{
    use WithPagination;
    public $name, $email, $username, $authorType, $direct_publisher;
    public $searchauthor = '';
    public $perPage = 4;
    public $selected_author_id;
    public $blocked = 0;

    public $listeners = [
        'resetForms'
    ];

    public function resetForms()
    {
        $this->name = $this->email = $this->username = $this->authorType = $this->direct_publisher = null;
        $this->resetErrorBag();
    }

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
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

    public function editAuthor($author)
    {
        // dd($author);
        $this->selected_author_id = $author['id'];
        $this->name = $author['name'];
        $this->email = $author['email'];
        $this->username = $author['username'];
        $this->authorType = $author['type'];
        $this->direct_publisher = $author['direct_publish'];
        $this->blocked = $author['blocked'];
        $this->dispatch('showEditAuthorModal');
    }

    public function updateAuthor()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->selected_author_id,
            'username' => 'required|min:6|max:20|unique:users,username,' . $this->selected_author_id,
        ]);

        if ($this->selected_author_id) {
            $author = User::find($this->selected_author_id);
            $author->update([
                'name' => $this->name,
                'email' => $this->email,
                'username' => $this->username,
                'type' => $this->authorType,
                'blocked' => $this->blocked,
                'direct_publish' => $this->direct_publisher,
            ]);
        }

        $this->showToastr('Author detail has been updated', 'success');
        $this->dispatch('hide_edit_author_modal');
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
            'authors' => User::search(trim($this->searchauthor))
                ->where('id', '!=', auth()->id())->paginate($this->perPage),
        ]);
    }
}
