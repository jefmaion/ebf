<div>
<div class="row g-2 align-items-center mb-3">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Overview</div>
                <h2 class="page-title">Usuários</h2>

                <!-- BEGIN MODAL -->
                <!-- END MODAL -->
              </div>
              <div class="col-auto ms-auto d-print-none">
                  <div class="btn-list">
                  <a href="#" class="btn btn-primary btn-5 d-none d-sm-inline-block" wire:click="$dispatch('create-user')">


                    Novo Usuario
                  </a>
                  <a href="#" class="btn bg-purple btn-6 d-sm-none btn-icon" wire:click="$dispatch('create-user')">
                    <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                    Add
                  </a>
                </div>
              </div>
            </div>


    <div class="card">


        <div class="card-header">
            <input type="text" class="form-control" wire:model.live="search" placeholder="Pesquisar">
        </div>


            <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Email</th>
                          <th>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr >
                          <td>
                          {{ $user->name }}
                          </td>

                          <td>
                            {{ $user->email }}
                          </td>

                          <td>
                              <button class="btn" wire:click="$dispatch('update-user', {user: {{ $user->id }}})">Editar</button>
                              <button class="btn" wire:click="$dispatch('delete-user', {user: {{ $user->id }}})">Excluir</button>
                              <button class="btn" wire:click="sendEmail({{$user->id}})">Resetar e enviar senha de acesso</button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

            <div class="card-footer">
                {{ $users->links() }}
            </div>

    </div>

    <livewire:user.user-form />

    <x-modal.modal-delete />

</div>
