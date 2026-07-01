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

    <div class="card">
        <div class="card-header">
            <input type="text" class="form-control" wire:model.live="search" placeholder="Pesquisar">

        </div>


            <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Title</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($children as $child)
                        <tr>
                          <td>{{ $child->childname }}</td>
                          <td class="text-secondary">{{ $child->childage }}</td>
                          <td class="text-secondary">{{ $child->name }} - {{ $child->phone }}</td>
                          <td class="text-secondary">@if(empty($child->checkin_date)) Sem Checkin @else Checkin @endif</td>
                          <td>
                              
                              <button class="btn" wire:click="$dispatch('show-checkin', {register: {{ $child }}})">Checkin</button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

            <div class="card-footer">
                {{ $children->links() }}
            </div>
       
    </div>

    <livewire:checkin.checkin-show />

</div>
