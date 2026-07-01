<?php

namespace App\Livewire\Checkin;

use Livewire\Component;

class CheckinCam extends Component
{
     public $code = '';

    public function qrCodeRead($code)
    {
        $this->code = $code;

        // aqui você pode buscar no banco
        // Criança::where('codigo', $code)->first();

        $this->dispatch('qrcode-found', code: $code);
    }

    public function render()
    {
        return view('livewire.checkin.checkin-cam');
    }
}
