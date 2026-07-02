<div wire:ignore.self class="modal modal-blur fade" id="modal-show-checkin" tabindex="-1" role="dialog"
    aria-hidden="true">
    @if($register)
    <div class="modal-dialog modasl-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-auto">
                        <span class="avatar avatar-xl"> {{ $register->id }} </span>
                    </div>
                    <div class="col">
                        <h1>{{ $register->childname }}</h1>
                        <p class="text-muted">{{ $register->childage }} anos - Gênero: {{ $register->childgender }}</p>
                        <p class="text-muted"><strong>Responsável: </strong>{{ $register->name }}</p>
                    </div>
                </div>
                @if(!empty($register->food_restriction))
                <p><strong>Restrição alimentar: </strong>{{ $register->food_restriction }}</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn  btn-primary" wire:click="doCheckin()">Realizar Check{{ $type ==
                    'checkin' ? 'In' : 'Out' }}</button>
            </div>
        </div>
    </div>
    @endif
</div>
