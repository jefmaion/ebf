<div>

        <div>

        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Overview</div>
                <h2 class="page-title">Participantes</h2>

                <!-- BEGIN MODAL -->
                <!-- END MODAL -->
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">

                    <a href="#" class="btn btn-primary btn-5 d-none d-sm-inline-block" data-bs-toggle="modal"
                        data-bs-target="#modal-report">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-2">
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Imprimir Todas
                    </a>
                    <a href="#" class="btn btn-primary btn-6 d-sm-none btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-report" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-2">
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                    </a>
                </div>
                <!-- BEGIN MODAL -->
                <!-- END MODAL -->
            </div>
        </div>

        <div class="modal modal-blur fade" id="modal-report" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deseja Imprimir todas as etiquetas?
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary btn-3" data-bs-dismiss="modal"> Cancel </a>
                        <a href="#" class="btn btn-primary btn-5 ms-auto" data-bs-dismiss="modal" wire:click='printAll()'>
                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-2">
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Sim
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>

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
                            <span class="avatar avatar-2 me-2"
                                style="background-image: url({{ $child->photo() }})"></span>
                            <div class="flex-fill">
                                <div class="font-weight-medium">{{ $child->childname }}</div>
                                <div class="text-secondary">{{ $child->childage }} anos - {{ $child->getGender() }}
                                </div>
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
                        <button class="btn btn-sm"
                            wire:click="$dispatch('show-participant', {register: {{ $child->id }}})">Ver</button>
                        <button class="btn btn-sm"
                            wire:click="$dispatch('edit-checkin', {register: {{ $child->id }}})">Editar</button>
                        <button class="btn btn-sm"
                            wire:click="$dispatch('delete-checkin', {register: {{ $child->id }}})">Excluir</button>
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


</div>
