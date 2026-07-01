<?php

namespace App\Livewire\Checkin;

use Livewire\Component;
use App\Models\Register;
use Livewire\WithPagination;

use Livewire\Attributes\On;


class CheckinPage extends Component
{

    use WithPagination;

    public $search = '';


    #[On('checkin-changed')]
    public function refresh() {
        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view('livewire.checkin.checkin-page', [
            'children' => Register::whereLike('childname', '%' . $this->search . '%')->orWhereLike('hash', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
