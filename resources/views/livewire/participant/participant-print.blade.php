<div wire:ignore.self class="modal modal-blur fade" id="modal-print" tabindex="-1" role="dialog"
    aria-hidden="true">
    @if($participants)
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Fazer Checkin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <table class="table table-vcenter card-table table-sm">
                @foreach($participants as $participant)
                <tr>
                    <td><label class="form-check mb-0">
                                  <input class="form-check-input" type="checkbox" wire:model="toPrint" value="{{ $participant->id }}">
                                  <span class="form-check-label">{{ $participant->childname }}</span>
                                </label> </td>
                </tr>
                @endforeach
              </table>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn w-50 btn-primary" wire:click="print()">Imprimir</button>
            </div>
        </div>
    </div>
    @endif
</div>
