<?php

namespace App\Livewire\Checkin;

use Livewire\Component;
use App\Models\Register;
use Livewire\WithPagination;

use Livewire\Attributes\On;


class CheckinPage extends Component
{

    use WithPagination;

    public ?Register $register = null;

    public $search = '';

    public function qrReader() {
        $this->dispatch('show-reader');
    }

    #[On('checkin-changed')]
    public function refresh() {
        $this->dispatch('$refresh');
        $this->search = null;
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



        return view('livewire.checkin.checkin-page', [
            'children' => Register::WhereLike('childname', '%' . $this->search . '%')->orWhereLike('hash', '%' . $this->search . '%')->orWhereLike('phone', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
