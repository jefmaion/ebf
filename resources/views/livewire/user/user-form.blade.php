<div>
    <x-modal.modal id="modal-form-user">
<form wire:submit="save()">
       <div class="modal-header">
        <h5 class="modal-title">Registrar Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">

       <div class="row row-cards mb-3">
        <div class="col-md-12">
            <label class="form-label ('mainName') }}">Nome</label>
          <x-form.input-text class="" type="text" name="name" wire:model="name" />
      </div>

      <div class="col-sm-12 col-md-12">
          <label class="form-label ('mainEmail') }}">Email </label>
          <x-form.input-text class="" type="data" name="email" wire:model="email" />
          <span class="mt-1"></span>

      </div>

  </div>

</div>



<div class="modal-footer">
    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
    <button type="submit" class="btn btn-orange w-1s00">
            Salvar
        </button>

</div>

</form>
</x-modal.modal>

</div>
