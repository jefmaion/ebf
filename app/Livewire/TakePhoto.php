<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\Attributes\On;


class TakePhoto extends Component
{

    public $photo;

    #[On('take-photo')]
    public function show() {
        $this->dispatch('show-modal', modal:'modal-take-photo');
    }

    public function setPhoto($photo) {

        $photo = preg_replace('#^data:image/\w+;base64,#i', '', $photo);
        // $decodedPhoto = base64_decode($photo);

        
        $this->dispatch('photo-result', photo:$photo);
        $this->dispatch('hide-modal', modal: 'modal-take-photo');
    }

    public function render()
    {
        return view('livewire.take-photo');
    }
}
