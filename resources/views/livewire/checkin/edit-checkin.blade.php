

<x-modal.modal id="modal-edit-checkin">
  <livewire:take-photo />
  @if($register)
 <form wire:submit="save()">
        <div class="modal-header">
                <h5 class="modal-title">Editar Participante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="row">
                  <div class="col"><x-general.resp-part :register="$register" /></div>
                  <div class="col-auto">
                    <button type="button" class="btn btn-purple " wire:click="$dispatch('take-photo')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2rem" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=""><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" /><path d="M9 13a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                </button>
                  </div>
                </div>
                


              </div>
            <div class="modal-body">
          
          @include('livewire.checkin.checkin-form')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
          
          <button type="submit" class="btn  btn-primary">Salvar</button>
        </div>
      </form>
     
@endif
       

</x-modal.modal>
