<div>
  <x-slot:header>


    <div class="row g-2 align-items-center">
      <div class="col">
<!-- Page pre-title -->
<div class="page-pretitle">Overview</div>
<h2 class="page-title">Participantes</h2>

<!-- BEGIN MODAL -->
<!-- END MODAL -->
</div>
</div>

</x-slot:header>

<div class="row row-cards mb-3">
  <div class="col-md-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="subheader">Participantes</div>
        </div>
        <div class="h1 mb-3">{{ $box['all'] }}</div>

      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="subheader">Presentes</div>
        </div>
        <div class="h1 mb-3">{{ $box['presents'] }}</div>

      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="subheader">Ausentes</div>
        </div>
        <div class="h1 mb-3">{{ $box['absense'] }}</div>

      </div>
    </div>
  </div>
</div>

<div class="card">

  <a href="#" wire:click="$dispatch('show-print')">AS</a>
  <div class="card-header">
    <input type="text" class="form-control" wire:model.live="search" placeholder="Pesquisar">
  </div>


  <table class="table table-vcenter card-table table-striped">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Responsavel</th>
        <th>Status</th>
        <th>Checkin</th>
        <th>Checkout</th>
        <th>Tempo</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($children as $child)
      <tr class="{{ $child->bracelet() }}">
        <td>
          <div class="d-flex py-1 align-items-center">
            <span class="avatar avatar-2 me-2" style="background-image: url({{ $child->photo() }})"></span>
            <div class="flex-fill">
              <div class="font-weight-medium">{{ $child->childname }}</div>
              <div class="text-secondary">{{ $child->childage }} anos - {{ $child->getGender() }}</div>
            </div>
          </div>
        </td>

        <td>
          <x-general.resp-box :register="$child" />
        </td>
        <td>
          <x-general.badge-part-status :register="$child" />
        </td>
        <td>{{ $child->checkin_date?->format('H:i') }}</td>
        <td>{{ $child->checkout_date?->format('H:i') ?? '-' }}</td>
        <td>{{ $child->getTime() }}</td>
        <td>
          <button class="btn btn-sm" wire:click="$dispatch('show-participant', {register: {{ $child->id }}})">Ver</button>
          <button class="btn btn-sm" wire:click="$dispatch('edit-checkin', {register: {{ $child->id }}})">Editar</button>
          <button class="btn btn-sm" wire:click="$dispatch('delete-checkin', {register: {{ $child->id }}})">Excluir</button>
          <button class="btn btn-sm" wire:click="sendEmail({{ $child->id }})">Enviar QR</button>
          <button class="btn btn-sm" wire:click="print({{ $child->id }})">Imprimir</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="card-footer">
    {{ $children->links() }}
  </div>

</div>

<x-modal.modal-delete />
<livewire:participant.participant-show />
<livewire:checkin.edit-checkin />
<livewire:participant.participant-print />

@script
<script>
    window.addEventListener('print-cupom', (event) => {

    const c = event.detail.cupom;

    const html = `
        <html>
        <head>
            <style>

                /* 🔥 TAMANHO REAL DA ETIQUETA */
                @page {
                    size: 58mm 30mm;
                    margin: 0;
                }

                body {
                    margin: 0;
                    padding: 0;
                    width: 58mm;
                    height: 30mm;
                    font-family: monospace;
                    overflow: hidden;
                }

                /* container principal */
                .cupom {
                    width: 58mm;
                    height: 30mm;
                    box-sizing: border-box;

                    padding: 2mm;

                    display: flex;
                    flex-direction: column;
                    justify-content: center;

                    font-size: 10px;
                    line-height: 1.2;
                }

                .titulo {
                    text-align: center;
                    font-weight: bold;
                    font-size: 11px;

                    /* evita estourar altura */
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                .cliente {
                    margin-top: 2mm;
                    text-align: center;

                    font-size: 9px;

                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                hr {
                    border: none;
                    border-top: 1px dashed #000;
                    margin: 2mm 0;
                }

            </style>
        </head>

        <body onload="window.print(); setTimeout(() => window.close(), 300);">

            <div class="cupom">

                <div class="titulo">${c.titulo}</div>

                <hr>

                <div class="cliente">${c.cliente}</div>

            </div>

        </body>
        </html>
    `;

    const w = window.open('', '_blank');

    w.document.open();
    w.document.write(html);
    w.document.close();
});
</script>
@endscript
</div>
