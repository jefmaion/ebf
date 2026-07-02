<?php

namespace App\Livewire\Participant;

use App\Models\Register;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipantPage extends Component
{

    use WithPagination;

    public ?Register $register = null;

    public $search = '';


    #[On('checkin-changed')]
    public function refresh() {
        $this->dispatch('$refresh');
    }

    #[On('delete-checkin')]
    public function confirmDelete(Register $register) {
        $this->register = $register;
        $this->dispatch('show-modal', modal:'modal-delete');
    }

    #[On('delete-item')]
    public function delete() {
        $this->register->delete();
        $this->register = null;
        $this->dispatch('hide-modal', modal:'modal-delete');
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.participant.participant-page', [
            'children' => Register::whereLike('childname', '%' . $this->search . '%')->orWhereLike('hash', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
