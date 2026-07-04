<?php

namespace App\Livewire\Checkin;

use App\Models\Register;
use Livewire\Attributes\On;
use Livewire\Component;

class QrReader extends Component
{

    public ?Register $register = null;
    public $message = null;

    #[On('show-reader')]
    public function show() {
        $this->dispatch('show-modal', modal: 'qrModal');
    }

    public function close() {
        $this->dispatch('hide-modal', modal: 'qrModal');
    }

    #[On('qr-code-read')]
    public function qrCodeReasd($code){

        $register = Register::where('hash', $code)->first();

        if (!$register) {
            $this->dispatch('qr-invalid');
            return;
        }
        $this->close();
        $this->dispatch('qrcode-loaded', register: $register->id);

    }

    public function render()
    {
        return view('livewire.checkin.qr-reader');
    }
}
