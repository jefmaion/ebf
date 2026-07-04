<?php

namespace App\Livewire\CHeckout;

use App\Models\Register;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CheckoutPage extends Component
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
        return view('livewire.c-heckout.checkout-page', [
            'children' => Register::whereNotNull('checkin_date')->whereNull('checkout_date')
                ->where(function ($query) { 
                    $query->whereLike('childname', '%' . $this->search . '%')
                        ->orWhereLike('hash', '%' . $this->search . '%')
                        ->orWhereLike('name', '%' . $this->search . '%')
                        ->orWhereLike('email', '%' . $this->search . '%')
                        ->orWhereLike('childage', '%' . $this->search . '%')
                        ->orWhereLike('phone', '%' . $this->search . '%'); 
                    })
            ->orderBy('checkin_date', 'desc')->paginate(10)
        ]);
    }
}
