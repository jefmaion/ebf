<div>
    <x-slot:header>


        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Overview</div>
                <h2 class="page-title">Dashboard</h2>

                <!-- BEGIN MODAL -->
                <!-- END MODAL -->
            </div>
        </div>

    </x-slot:header>

    <a href="{{route('cam')}}">Ler QrCOde</a> |  <a href="#" wire:click="$dispatch('show-reader')">Ler QrCOde</a>
    <div class="card">
        <div class="card-header">
            <input type="text" class="form-control" wire:model.live="search" placeholder="Pesquisar">

        </div>


        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead class="d-none d-md-table-header-group">
                    <tr>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>Responsável</th>
                        <th>Status</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                {{-- Mobile --}}
                <thead class="d-table-header-group d-md-none">
                    <tr>
                        <th>Crianças</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($children as $child)
                    <tr class="d-none d-md-table-row">
                        <td>{{ $child->childname }}</td>
                        <td class="text-secondary">{{ $child->childage }}</td>
                        <td class="text-secondary">{{ $child->name }} - {{ $child->phone }}</td>
                        <td class="text-secondary">@if(empty($child->checkin_date)) Sem Checkin @else Checkin @endif
                        </td>
                        <td>{{ $child->checkin_date }}</td>
                        <td>{{ $child->checkout_date }}</td>
                        <td>

                            <button class="btn"
                                wire:click="$dispatch('show-checkin', {register: {{ $child }}, type:'checkin'})">CheckIn</button>
                            <button class="btn"
                                wire:click="$dispatch('show-checkin', {register: {{ $child }}, type:'checkout'})">CheckOut</button>
                            <button class="btn"
                                wire:click="$dispatch('edit-checkin', {register: {{ $child }}})">Editar</button>
                            <button class="btn"
                                wire:click="$dispatch('delete-checkin', {register: {{ $child }}})">Excluir</button>
                        </td>
                    </tr>

                    <tr class="d-table-row d-md-none">
                        <td colspan="7">

                            <div class="">
                                <div>
                                    <strong>{{ $child->childname }}</strong>
                                    <br>
                                    <small class="text-secondary">
                                        {{ $child->childage }} anos
                                    </small>
                                    <br>
                                    <small>
                                        Responsável: {{ $child->name }}
                                    </small>
                                    <br>
                                    <small>
                                        {{ $child->phone }}
                                    </small>
                                    <br>
                                    <span class="badge
                                        @if($child->checkin_date)
                                            bg-success
                                        @else
                                            bg-secondary
                                        @endif">

                                        @if($child->checkin_date)
                                            Check-in realizado
                                        @else
                                            Sem Check-in
                                        @endif
                                    </span>
                                </div>

                                <div class="mt-3">
                                  <button class="btn-sm p-2 btn"
                                wire:click="$dispatch('show-checkin', {register: {{ $child }}, type:'checkin'})">CheckIn</button>
                            <button class="btn-sm p-2 btn"
                                wire:click="$dispatch('show-checkin', {register: {{ $child }}, type:'checkout'})">CheckOut</button>
                            <button class="btn-sm p-2 btn"
                                wire:click="$dispatch('edit-checkin', {register: {{ $child }}})">Editar</button>
                            <button class="btn-sm p-2 btn"
                                wire:click="$dispatch('delete-checkin', {register: {{ $child }}})">Excluir</button>
                                </div>

                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $children->links() }}
        </div>

    </div>

    <livewire:checkin.checkin-show />
    <livewire:checkin.edit-checkin />

    <livewire:checkin.qr-reader />

    <x-modal.modal-delete />

</div>
