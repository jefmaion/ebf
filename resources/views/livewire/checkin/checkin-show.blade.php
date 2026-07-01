<div wire:ignore.self class="modal modal-blur fade" id="modal-show-checkin" tabindex="-1" role="dialog" aria-hidden="true">
    @if($register)
  <div class="modal-dialog modasl-lg modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body text-center">

        <img src="{{ asset('storage/qrcodes/'.$register->hash.'.png') }}" class="mb-4" width="200px" alt="QR Code">


        <h1>{{ $register->childname }}</h1>
        <p>{{ $register->childage }} anos</p>



        <p>Responsável: </p>
        <strong>
            {{ $register->name }}
        </strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" wire:click="print()">Imprimir Etiqueta</button>
        <button type="button" class="btn btn-primary" wire:click="">CheckOut</button>
        <button type="button" class="btn btn-primary" wire:click="doCheckin()">CheckIn</button>
      </div>
    </div>
  </div>
  @endif
</div>
