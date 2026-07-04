<x-modal.modal id="modal-show-checkin">
      @if($register)
         <div class="modal-header">
                <h5 class="modal-title">Fazer Checkin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
            @if(!$takePhoto)
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
             @if(!empty($register->food_restriction))
            <div class="modal-body text-center">
                <p class="m-0"><strong>Restrição alimentar: </strong>{{ $register->food_restriction }}</p>

            </div>
            @endif
            @endif


            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-purple " wire:click="$dispatch('take-photo')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2rem" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=""><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" /><path d="M9 13a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                </button>
                <button type="button" class="btn w-50 btn-primary" wire:click="doCheckin()">Realizar CheckIn</button>
            </div>
        @endif
        <livewire:take-photo />
</x-modal.modal>

