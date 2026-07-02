<?php

namespace App\Livewire\Checkin;

use App\Livewire\Forms\Register\FormRegister;
use App\Models\Register;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class EditCheckin extends Component
{   

    public FormRegister $form;

    public Register $register;

     #[On('edit-checkin')]
    public function select(Register $register) {
        $this->register = $register;
        // $this->form->reset();
        $this->form->populate($register);
        $this->form->resetValidation();
        $this->dispatch('show-modal', modal:'modal-edit-checkin');
    }

    public function save() {
        $this->form->update();
        $this->dispatch('checkin-changed');
        $this->dispatch('hide-modal', modal:'modal-edit-checkin');
    }

    public function getAge() {
        $this->form->childage = Carbon::parse($this->form->childbirthdate)->age;
    }


    public function render()
    {
        return view('livewire.checkin.edit-checkin');
    }
}
