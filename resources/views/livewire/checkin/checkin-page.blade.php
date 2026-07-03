<div>

    <div class="row g-2 align-items-center mb-2">
        <div class="col">
            <!-- Page pre-title -->
            <h2 class="page-title">Checkin</h2>

            <!-- BEGIN MODAL -->
            <!-- END MODAL -->
        </div>
        <div class="col">
            asd
        </div>
    </div>

    <a href="{{route('cam')}}">Ler QrCOde</a> | <a href="#" wire:click="$dispatch('show-reader')">Ler QrCOde</a>
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
                    <td class="d-flex align-items-center"><span class="avatar avatar-lg me-3"
                            style="background-image: url({{ $child->photo() }})"> </span> {{ $child->childname }}</td>
                    <td class="text-secondary">
                        <span class="badge bg-{{ $child->bracelet() }} text-{{ $child->bracelet() }}-fg px-4">{{
                            $child->childage }} anos</span>
                    </td>
                    <td class="text-secondary">{{ $child->name }}</td>
                    <td class="text-secondary">{{ $child->phone }}
                    </td>

                    <td>
                        @if($child->checkin_date)
                        Checkin Realizado
                        @else

                        <button class="btn btn-primary w-100"
                            wire:click="$dispatch('make-checkin', {register: {{ $child }}})">Fazer CheckIn</button>
                        @endif

                    </td>
                </tr>

                <tr class="d-md-none">
                    <td>
                        <div class="row">
                            <div class="col-auto"><span class="avatar avatar-lg me-s3"
                                    style="background-image: url({{ $child->photo() }})"> </span></div>
                            <div class="col">
                                <div>{{ $child->childname }}</div>
<span
                                    class="badge bg-{{ $child->bracelet() }} text-{{ $child->bracelet() }}-fg px-4">{{
                                    $child->childage }} anos</span>
                            </div>

                            <div class="col-auto text-end">
                                <button class="btn btn-primary w-1ds00"
                                    wire:click="$dispatch('make-checkin', {register: {{ $child }}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                        <path d="M15 19l2 2l4 -4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div> </div>

                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $children->links() }}
        </div>

    </div>


    <livewire:checkin.checkin />


    <livewire:checkin.qr-reader />



</div>
