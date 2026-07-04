<div>
    @if($register)

    <x-modal.modal id="modal-show-part">



 <div class="modal-header">
        <h5 class="modal-title">Fazer CheckOut</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

    <div class="modal-body">
  
        <div class="row">
            <div class="col">
                <x-general.resp-part :register="$register" />
            </div>
            <div class="col">
                <x-general.resp-box :register="$register" />
            </div>
        </div>
        
    </div>



    <div class="modal-footer">
        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
        <button class="btn" wire:click="$dispatch('edit-checkin', {register: {{ $register->id }}})">Editar</button>
        @if(empty($register->checkin_date) && (empty($register->checkin_date) && empty($register->checkout_date)))
        <button class="btn btn-primary w-s100" wire:click="$dispatch('make-checkin', {register: {{ $register->id }}})">CheckIn</button>
        @endif

        @if(empty($register->checkout_date) && !empty($register->checkin_date))
        <button class="btn btn-orange w-1s00" wire:click="$dispatch('make-checkout', {register: {{ $register->id }}})">
            Fazer CheckOut
        </button>
        @endif
    </div>
   

   
</x-modal.modal>

   <livewire:c-heckout.checkout />
<livewire:checkin.checkin />


@endif

</div>
