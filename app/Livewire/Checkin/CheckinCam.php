<?php

namespace App\Livewire\Checkin;

use App\Models\Register;
use Livewire\Component;

class CheckinCam extends Component
{
     public $code = '';
     public ?Register $register = null;

     public function mount() {
        // $this->register = Register::first();
     }

    public function doCheckin() {
        // gerar hash
        // imprimir etiqueta
        $this->register->update(['checkin_date' => now(), 'user_id_checkin' => auth()->user()->id]);
        $this->register = null;
        $this->dispatch('start-scanner');
        // $this->dispatch('hide-modal', modal:'modal-show-checkin');
        // $this->dispatch('checkin-changed');
    }

    public function qrCodeRead($code)
    {
        $this->code = $code;

        // aqui você pode buscar no banco
        // Criança::where('codigo', $code)->first();

        $this->register = Register::where('hash', $code)->first();



        $this->dispatch('qrcode-found', code: $code);

    }

    public function render()
    {
        return view('livewire.checkin.checkin-cam');
    }
}
