<?php

namespace App\Livewire\User;

use App\Models\Register;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

use Illuminate\Validation\Rule;

class UserForm extends Component
{

    public ?User $user = null;

    public $name;
    public $email;

    #[On('create-user')]
    public function create() {
        $this->dispatch('show-modal', modal:'modal-form-user');
    }

    #[On('update-user')]
    public function edit(User $user) {
        $this->user = $user;

        $this->name = $this->user->name;
        $this->email = $this->user->email;

        $this->dispatch('show-modal', modal:'modal-form-user');
    }

    public function rules() {
        return [
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')->where('email', $this->email)->ignore($this->user?->id)],

        ];
    }

    public function save() {

        $this->validate();


        if(empty($this->user)) {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make('password')
            ]);
        } else {

            $this->user->update([
                'name' => $this->name,
                'email' => $this->email
            ]);

            $this->user = null;

        }


        $this->dispatch('hide-modal', modal:'modal-form-user');
        $this->dispatch('refresh-users');


    }

    public function render()
    {
        return view('livewire.user.user-form');
    }
}
