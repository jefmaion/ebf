<?php

namespace App\Livewire\Participant;

use App\Actions\PrintLabel;
use App\Models\Register;
use Livewire\Component;

use Livewire\Attributes\On;

class ParticipantPrint extends Component
{

    public $toPrint = [];

    #[On('show-print')]
    public function show() {
        $this->dispatch('show-modal', modal:'modal-print');
    }

    public function selectAll() {
        foreach(Register::all() as $register) {
            $this->toPrint[]  =$register->id;
        }
    }

    public function print() {
        $participants = Register::whereIn('id', $this->toPrint)->get();

        foreach($participants as $part) {
            PrintLabel::run($part);
        }
    }

    public function render()
    {
        return view('livewire.participant.participant-print', [
            'participants' => Register::orderBy('childname')->get()
        ]);
    }
}
