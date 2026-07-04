<?php

namespace App\Livewire\Participant;

use App\Actions\PrintLabel;
use App\Mail\WelcomeRegister;
use App\Models\Register;
use Illuminate\Support\Facades\Mail;
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

    public function sendEmail(Register $register) {
        Mail::to($register->email)->send(
            new WelcomeRegister(
                $register->name,
                $register->childname,
                $register->hash // O ID que a sua impressora MPT vai ler depois!
            )
        );
    }

    public function print(Register $register) {
        PrintLabel::run($register);
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Força o Livewire a voltar para a página 1
    }

    public function render()
    {


        return view('livewire.participant.participant-page', [
            'children' => Register::whereLike('childname', '%' . $this->search . '%')->orWhereLike('hash', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(10),

            'box' => [
                'all' => Register::count(),
                'presents' => Register::whereNotNull('checkin_date')->count(),
                'absense' => Register::whereNull('checkin_date')->count()
            ]
        ]);
    }
}
