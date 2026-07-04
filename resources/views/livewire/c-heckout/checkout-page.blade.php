<div>
    <livewire:checkin.qr-reader />
    <div class="row g-2 align-items-center mb-2">
        <div class="col">
            <!-- Page pre-title -->
            <h2 class="page-title">Checkout</h2>

            <!-- BEGIN MODAL -->
            <!-- END MODAL -->
        </div>
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <a href="#" class="btn bg-purple btn-5 d-none d-sm-inline-block" wire:click="$dispatch('show-reader')">
                <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" /><path d="M7 17l0 .01" /><path d="M14 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" /><path d="M7 7l0 .01" /><path d="M4 15a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" /><path d="M17 7l0 .01" /><path d="M14 14l3 0" /><path d="M20 14l0 .01" /><path d="M14 14l0 3" /><path d="M14 20l3 0" /><path d="M17 17l3 0" /><path d="M20 17l0 3" /></svg>
                Ler QR COde
            </a>
            <a href="#" class="btn bg-purple btn-6 d-sm-none btn-icon" wire:click="$dispatch('show-reader')">
                <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" /><path d="M7 17l0 .01" /><path d="M14 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" /><path d="M7 7l0 .01" /><path d="M4 15a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" /><path d="M17 7l0 .01" /><path d="M14 14l3 0" /><path d="M20 14l0 .01" /><path d="M14 14l0 3" /><path d="M14 20l3 0" /><path d="M17 17l3 0" /><path d="M20 17l0 3" /></svg>
            </a>
        </div>
        <!-- BEGIN MODAL -->
        <!-- END MODAL -->
    </div>
</div>

<!-- <a href="{{route('cam')}}">Ler QrCOde</a> | <a href="#" wire:click="$dispatch('show-reader')">Ler QrCOde</a> -->
<div class="card mb-3">
    <div class="card-header">
        <input type="text" class="form-control form-control-lg" wire:model.live="search" placeholder="Pesquisar">
    </div>

    <table class="table table-vcenter table-sm card-table table-striped">
        <thead class="d-none d-md-table-header-group">
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>Responsável</th>
                <th>Telefone</th>
                <th>Telefone</th>
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
            {{-- Versão Desktop --}}
            <tr class="d-none d-md-table-row">
                



                <td>
                    <x-general.resp-part :register="$child" />
                </td>
                <td >
                    <x-general.badge-age :register="$child" />
                </td>
                <td >
                    <x-general.resp-box :register="$child" />
                </td>
                <td>{{ $child->checkin_date }}</td>
                <td>
                    <button class="btn btn-orange w-100" wire:click="$dispatch('make-checkout', {register: {{ $child->id }}})">
                        Fazer CheckOut
                    </button>
                </td>
            </tr>

            {{-- Versão Mobile --}}
            <tr class="d-md-none">
                <td>
                    <div class="row align-items-center"> <!-- Adicionado align-items-center para alinhar a foto ao texto -->
                        <div class="col-auto">
                            <!-- Correção ortográfica de me-s3 para me-3 -->
                            <span class="avatar avatar-lg me-3" style="background-image: url({{ $child->photo() }})"></span>
                        </div>
                        <div class="col">
                            <div><strong>{{ $child->childname }}</strong></div>
                            <span class="badge bg-{{ $child->bracelet() }} text-{{ $child->bracelet() }}-fg px-2 mt-1">
                                {{ $child->childage }} anos
                            </span>
                        </div>
                        <div class="col-auto text-end">
                            <!-- Correção ortográfica de w-1ds00 para w-100 -->
                            <button class="btn btn-orange w-100" wire:click="$dispatch('make-checkout', {register: {{ $child->id }}})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                    <path d="M15 19l2 2l4 -4" />
                                </svg> Checkout
                                </</button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        <div class="mt-3">
            {{ $children->links() }}
        </div>

    </div>

    

    <livewire:c-heckout.checkout />


    



</div>
