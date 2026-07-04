<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserPage extends Component
{

    use WithPagination;

    public ?User $user = null;

    public $search = '';


    #[On('refresh-users')]
    public function refresh() {
        $this->dispatch('$refresh');
        $this->search = null;
    }

     #[On('delete-user')]
    public function confirmDelete(User $user) {
        $this->user = $user;
        $this->dispatch('show-modal', modal:'modal-delete');
    }

    #[On('delete-item')]
    public function delete() {
        $this->user->delete();
        $this->user = null;
        $this->dispatch('hide-modal', modal:'modal-delete');
        $this->refresh();
    }

    public function sendEmail(User $user) {
        Password::sendResetLink([
            'email' => $user->email,
        ]);
    }

    public function render()
    {
        return view('livewire.user.user-page', [
            'users' => User::whereLike('name', '%'.$this->search.'%')->whereLike('email', '%'.$this->search.'%')->paginate(10)
        ]);
    }
}
