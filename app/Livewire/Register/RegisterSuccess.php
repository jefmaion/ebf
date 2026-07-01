<?php

namespace App\Livewire\Register;

use Livewire\Component;
use Livewire\Attributes\Layout;

class RegisterSuccess extends Component
{

    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.register.register-success');
    }
}
