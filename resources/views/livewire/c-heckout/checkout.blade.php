<x-modal.modal id="modal-show-checkout">
      @if($register)
         <div class="modal-header">
                <h5 class="modal-title">Fazer CheckOut</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

            <div class="modal-body text-center">
                <div class="row">
                    <div class="col-12">
                        @if(!empty($register->photo))
                        <span class="avatar avatars-xsl mb-2" style="width:200px;height:200px;background-size: cover; background-position: center;background-image: url({{ $register->photo() }})"> </span>
                        @endif
                    </div>
                    <div class="col-12">
                        <h1>{{ $register->childname }}</h1>
                        <span class="badge bg-{{ $register->bracelet() }} text-{{ $register->bracelet() }}-fg px-4">{{ $register->childage }} anos</span>
                    </div>
                </div>
            </div>
            <div class="modal-body text-center">
                <p class="mb-0">Responsável</p>
                <h3 class="mb-0">{{ $register->name }}</h3>
                <h3 class="mb-0">{{ $register->phone }}</h3>
            </div>

            <div class="modal-body text-center">
                <div class="row">
                    <div class="col">
                        <p class="mb-0">Checkin</p>
                        <h2 class="mb-0">{{ $register->checkin_date->format('H:i') }}</h2>
                    </div>

                    <div class="col">
                        <p class="mb-0">Checkout</p>
                        <h2 class="mb-0">{{ $register->checkout_date?->format('H:i') ?? now()->format('H:i:s') }}</h2>
                    </div>

                    <div class="col">
                        <p class="mb-0">Permanência</p>
                        <h2 class="mb-0">{{ $register->getTime() }}</h2>
                    </div>
                </div>
                
            </div>



            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn w-50 btn-primary" wire:click="doCheckout()">Realizar CheckOut</button>
            </div>
        @endif    
</x-modal.modal>

