<?php

namespace App\Livewire\Checkin;

use App\Models\Register;
use Livewire\Attributes\On;
use Livewire\Component;

class QrReader extends Component
{

    public ?Register $register = null;

    #[On('show-reader')]
    public function show() {
        $this->dispatch('show-modal', modal: 'qrModal');
    }

    public function qrCodeRead($code)
    {


        $this->register = Register::where('hash', $code)->first();

        $this->dispatch('hide-modal', modal: 'qrModal');
         $this->dispatch('show-checkin', register: $this->register);

    }

    public function render()
    {
        return view('livewire.checkin.qr-reader');
    }
}
