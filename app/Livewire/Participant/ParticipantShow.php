<?php

namespace App\Livewire\Participant;

use App\Models\Register;
use Livewire\Attributes\On;
use Livewire\Component;

class ParticipantShow extends Component
{

    public ?Register $register = null;

    #[On('show-participant')]
    public function select(Register $register) {
        $this->register = $register;
        $this->dispatch('show-modal', modal:'modal-show-part');

    }

    public function render()
    {
        return view('livewire.participant.participant-show');
    }
}
