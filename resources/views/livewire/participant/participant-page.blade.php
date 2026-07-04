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
          <button class="btn" wire:click="$dispatch('show-participant', {register: {{ $child->id }}})">Ver</button>
          <button class="btn" wire:click="$dispatch('edit-checkin', {register: {{ $child->id }}})">Editar</button>
          <button class="btn" wire:click="$dispatch('delete-checkin', {register: {{ $child->id }}})">Excluir</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="card-footer">
    {{ $children->links() }}
  </div>

</div>

<livewire:participant.participant-show />
<livewire:checkin.edit-checkin />
<livewire:participant.participant-print />

<x-modal.modal-delete />

</div>
