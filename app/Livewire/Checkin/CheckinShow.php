<?php

namespace App\Livewire\Checkin;

use Livewire\Component;

use Livewire\Attributes\On;

use App\Models\Register;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class CheckinShow extends Component
{

    public Register $register;


    #[On('show-checkin')]
    public function show(Register $register) {
        $this->register = $register;
        $this->dispatch('show-modal', modal:'modal-show-checkin');
    }

    public function doCheckin() {
        // gerar hash
        // imprimir etiqueta
        $this->register->update(['checkin_date' => now(), 'user_id_checkin' => auth()->user()->id]);
        $this->dispatch('hide-modal', modal:'modal-show-checkin');
        $this->dispatch('checkin-changed');
    }

    public function print() {


        $connector = new WindowsPrintConnector("POS58");
        $printer = new Printer($connector);

        $printer->text("CHECK-IN EVENTO\n");
        $printer->text("Nome: ".$this->register->childname."\n");
        $printer->text("Código: ".$this->register->hash."\n");

        $printer->feed(2);
        $printer->cut();
        $printer->close();
    }

    public function render()
    {
        return view('livewire.checkin.checkin-show');
    }
}
