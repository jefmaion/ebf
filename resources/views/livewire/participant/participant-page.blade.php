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

    <div class="card">

        <a href="#" wire:click="$dispatch('show-print')">AS</a>
        <div class="card-header">
            <input type="text" class="form-control" wire:model.live="search" placeholder="Pesquisar">
        </div>


            <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Idade</th>
                          <th>Responsável</th>
                          <th>Telefone</th>
                          <th>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($children as $child)
                        <tr class="{{ $child->bracelet() }}">
                          <td> {{ $child->childname }}</td>
                          <td>{{ $child->childage }} anos</td>
                          <td>{{ $child->name }}</td>
                          <td>{{ $child->phone }}</td>
                          <td>
                              <button class="btn" wire:click="$dispatch('edit-checkin', {register: {{ $child }}})">Editar</button>
                              <button class="btn" wire:click="$dispatch('delete-checkin', {register: {{ $child }}})">Excluir</button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

            <div class="card-footer">
                {{ $children->links() }}
            </div>

    </div>

    <livewire:checkin.edit-checkin />
    <livewire:participant.participant-print />


    <x-modal.modal-delete />

</div>
