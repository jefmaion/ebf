<div>

    <div>

        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Overview</div>
                <h2 class="page-title">Participantes</h2>

                <!-- BEGIN MODAL -->
                <!-- END MODAL -->
            </div>
            <div class="col-auto ms-auto d-print-none">

                <div class="btn-list">
                     @if(auth()->user()->email == 'jefmaion@hotmail.com')
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
                    @endif

                    <a href="#" class="btn btn-primary btn-5 d-none d-sm-inline-block" wire:click="export()">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-2">
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Exportar Inscrições
                    </a>
                    <a href="#" class="btn btn-primary btn-6 d-sm-none btn-icon" wire:click="export()"
                        aria-label="Create new report">
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
                        <a href="#" class="btn btn-primary btn-5 ms-auto" data-bs-dismiss="modal"
                            wire:click='printAll()'>
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


        @foreach($box as $label => $value)
        <div class="col-sm-6 col-lg-2">
            <div class="card card-sm">
                <div class="card-status-start bg-primary"></div>
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col">
                            <div class="h1">{{ $value }}</div>
                            <div class="text-secondary">{{ $label }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach



    </div>

    <div class="card">


        <div class="card-header">
            <input type="text" class="form-control" wire:model.live="search" placeholder="Pesquisar">
        </div>


        <table class="table table-vcenter card-table table-striped">
            <thead class="d-none d-md-table-header-group">
                <tr>
                    <th>Nome</th>
                    <th>Responsavel</th>
                    <th>Data de Inscrição</th>
                    <th>Status</th>
                    <th>Checkin</th>
                    <th>Checkout</th>
                    <th>Tempo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <thead class="d-table-header-group d-md-none">
                <tr>
                    <th>Participantes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($children as $child)
                <tr class="d-none d-md-table-row">
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
                        {{ $child->created_at->format('d/m/y H:i')}}
                    </td>
                    <td>
                        <x-general.badge-part-status :register="$child" />
                    </td>
                    <td>{{ $child->checkin_date?->format('H:i') }}</td>
                    <td>{{ $child->checkout_date?->format('H:i') ?? '-' }}</td>
                    <td>{{ $child->getTime() }}</td>
                    <td>

                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown"
                                aria-expanded="false">Ações</button>
                            <div class="dropdown-menu dropdown-menu-end" style="">
                                <a class="dropdown-item" href="#"
                                    wire:click="$dispatch('show-participant', {register: {{ $child->id }}})"> Ver </a>
                                <a class="dropdown-item" href="#"
                                    wire:click="$dispatch('edit-checkin', {register: {{ $child->id }}})"> Editar </a>
                                <a class="dropdown-item" href="#"
                                    wire:click="$dispatch('delete-checkin', {register: {{ $child->id }}})"> Excluir </a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modal-send-qr-{{ $child->id }}"> Enviar QR </a>
                                <a class="dropdown-item" href="#" wire:click="print({{ $child->id }})"> Imprimir </a>
                            </div>
                        </div>


                    </td>
                </tr>

                <tr class="d-md-none">
                    <td>

                        <div class="d-flex py-1 align-items-center">
                            <span class="avatar avatar-2 me-2"
                                style="background-image: url({{ $child->photo() }})"></span>
                            <div class="flex-fill">
                                <div class="font-weight-medium">{{ $child->childname }}</div>
                                <div class="text-secondary">{{ $child->childage }} anos - {{ $child->getGender() }}
                                    <div class="text-secondary">Resp.: {{ $child->name }} ({{ $child->phone }})
                                    </div>
                                </div>
                            </div>

                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown"
                                aria-expanded="false">Ações</button>
                            <div class="dropdown-menu dropdown-menu-end" style="">
                                <a class="dropdown-item" style="cursor:pointer"
                                    wire:click="$dispatch('show-participant', {register: {{ $child->id }}})"> Ver </a>
                                <a class="dropdown-item" style="cursor:pointer"
                                    wire:click="$dispatch('edit-checkin', {register: {{ $child->id }}})"> Editar </a>
                                <a class="dropdown-item" style="cursor:pointer"
                                    wire:click="$dispatch('delete-checkin', {register: {{ $child->id }}})"> Excluir </a>
                                <a class="dropdown-item" style="cursor:pointer" data-bs-toggle="modal"
                                    data-bs-target="#modal-send-qr-{{ $child->id }}"> Enviar QR </a>
                                <a class="dropdown-item" style="cursor:pointer" wire:click="print({{ $child->id }})">
                                    Imprimir </a>
                            </div>
                        </div>
                    </td>
                </tr>

                <div class="modal modal-blur fade" id="modal-send-qr-{{ $child->id }}" tabindex="-1"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Enviar Email</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Deseja reenviar o eemail de QR Code para {{ $child->name }}?
                            </div>

                            <div class="modal-footer">
                                <a href="#" class="btn btn-link link-secondary btn-3" data-bs-dismiss="modal"> Fechar
                                </a>
                                <a href="#" class="btn btn-primary btn-5 ms-auto" data-bs-dismiss="modal"
                                    wire:click="sendEmail({{ $child->id }})">
                                    Sim
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

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
