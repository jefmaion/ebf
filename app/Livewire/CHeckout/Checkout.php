<?php

namespace App\Livewire\CHeckout;

use App\Models\Register;
use Livewire\Attributes\On;
use Livewire\Component;

class Checkout extends Component
{

    public ?Register $register = null;

    #[On('make-checkout')]
    #[On('qrcode-loaded')]
    public function select(Register $register) {
        $this->register = $register;
        $this->dispatch('show-modal', modal:'modal-show-checkout');

    }

    public function doCheckout() {
        $this->register->update(['checkout_date' => now(), 'user_id_checkout' => auth()->user()->id]);
        $this->dispatch('hide-modal', modal:'modal-show-checkout');
        $this->dispatch('checkin-changed');
    }

    public function render()
    {
        return view('livewire.c-heckout.checkout');
    }
}
