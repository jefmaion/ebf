<?php

namespace App\Livewire\Checkin;

use App\Actions\PrintLabel;
use App\Actions\SaveUserPhoto;
use App\Models\Register;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Checkin extends Component
{

    public ?Register $register = null;

    public $takePhoto = false;


    #[On('make-checkin')]
    #[On('qrcode-loaded')]
    public function select(Register $register) {
        $this->register = $register;
        $this->dispatch('show-modal', modal:'modal-show-checkin');

    }

     public function getPhoto() {

        $this->takePhoto = (!$this->takePhoto);
    }

    #[On('photo-result')]
    public function setPhoto($photo)
    {


        SaveUserPhoto::run($this->register, $photo);
        
        $this->register->refresh();

        $this->takePhoto = false;

        $this->dispatch('$refresh');

    }

    public function doCheckin() {

        $this->register->update(['checkin_date' => now(), 'user_id_checkin' => auth()->user()->id]);
        $this->dispatch('hide-modal', modal:'modal-show-checkin');
        $this->dispatch('checkin-changed');
    }

    public function print() {
        PrintLabel::run($this->register);



    }


    public function render()
    {
        return view('livewire.checkin.checkin');
    }
}
