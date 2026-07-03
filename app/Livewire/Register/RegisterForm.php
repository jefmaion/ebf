<?php

namespace App\Livewire\Register;

use App\Livewire\Forms\Register\FormRegister;
use App\Models\Register;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegisterForm extends Component
{


    public FormRegister $form;

    public $max = 500;
    public $canRegister = true;

    public $next = 2;
    public $current = 1;
    public $previous = 0;


    public function getAge() {
        $this->form->childage = Carbon::parse($this->form->childbirthdate)->age;
    }


    public function mount() {
        $this->canRegister = Register::count() < $this->max;
    }


    public function nextPage($val) {
        $this->form->_step = $this->current;
        $this->form->validate();
        $this->refreshPagination($val);
    }

    public function previousPage($val) {
        $this->refreshPagination($val);
    }

    public function refreshPagination($val) {
        $this->current = $val;
        $this->next = $this->current + 1;
        $this->previous = ($this->current - 1) == 0 ? 1 : $this->current - 1;
    }


    public function save() {

        $register = $this->form->store();

        // enviar email
        // enviar zap

        return redirect('success');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.register.register-form');
    }
}
