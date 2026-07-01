<div> 

  <h1 class="dissplay-4 text-center my-5">EBD - Igreja do Nazareno Vila Anchieta</h1>

@if($canRegister)
  
  <div>
    <ul class="steps steps-green steps-counter my-4 p-0 border-0 flex-row">
      <li class="step-item {{ $this->current == 1 ? 'active' : '' }} "><span class="sh1">Responsável</span></li>
      <li class="step-item {{ $this->current == 2 ? 'active' : '' }} "><span class="sh1">Dados da Criança</span></li>
      <li class="step-item {{ $this->current == 3 ? 'active' : '' }} "><span class="sh1">Confirmação</span></li>
    </ul>
  </div>


  <form wire:submit="save()">

    <div class="card mb-4 {{ $current !== 1 ? 'd-none' : '' }}">
      <div class="card-header">
        <h1 class="m-0 ">Informações do Responsável</h1>
      </div>
      <div class="card-body">
        <div class="row row-cards mb-3">
          <div class="col-md-12">
            <label class="form-label h2 ('mainName') }}">Responsável</label>
            <x-form.input-text class="form-control-lg" type="text" name="name" wire:model="name" />
          </div>

          <div class="col-sm-12 col-md-12">
            <label class="form-label h2 ('mainEmail') }}">Email </label>
            <x-form.input-text class="form-control-lg" type="data" name="email" wire:model="email" />
            <span class="mt-1"></span>

          </div>


          <div class="col-sm-12 col-md-12">
            <label class="form-label h2 ('mainPhone') }}">Telefone/WhatsApp</label>
            <x-form.input-text class="form-control-lg" type="data" name="phone" wire:model="phone" />
          </div>

        </div>
      </div>
    </div>

    <div class="card mb-4 {{ $current !== 2 ? 'd-none' : '' }}">
      <div class="card-header">
        <h1 class="m-0 ">Dados da criança</h1>
      </div>
      <div class="card-body">
        <div class="row row-cards mb-3">
          <div class="col-md-12">
            <label class="form-label h2 ('name') }}">Nome da criança</label>
            <x-form.input-text class="form-control-lg" type="text" name="childname" wire:model="childname" />
          </div>
          <div class="col-sm-12 col-md-4">
            <label class="form-label h2 ('birthdate') }}">Data de Nascimento</label>
            <x-form.input-text class="form-control-lg" type="date" name="childbirthdate" wire:model="childbirthdate" />
          </div>
          <div class="col-sm-12 col-md-4">
            <label class="form-label h2 ('age') }}">Idade</label>
            <x-form.input-text class="form-control-lg" type="number" name="childage" wire:model="childage" />
          </div>
          <div class="col-sm-12 col-md-4">
            <label class="form-label h2 ('gender') }}">Sexo</label>
            <x-form.input-text class="form-control-lg" type="data" name="childgender" wire:model="childgender" />
          </div>

          <div class="col-sm-12 col-md-12">
            <label class="form-label h2 ('church') }}">Igreja que a criança participa</label>
            <x-form.input-text class="form-control-lg" type="data" name="childchurch" wire:model="childchurch" />
          </div>



        </div>
      </div>
    </div>


    <div class="card mb-4 {{ $current !== 3 ? 'd-none' : '' }}">
      <div class="card-header">
        <h1 class="m-0 ">Confirmação</h1>
      </div>
      <div class="card-body">

        <p><strong>Responsável: </strong> {{ $name }}</p>
        <p><strong>Telefone: </strong> {{ $phone }}</p>
        <p><strong>Email: </strong> {{ $email }}</p>
        <hr>
        
        <p>
          Ciência sobre cardápio oferecido a fim de amenizar reações alérgicas — bolo de chocolate, bolo de cenoura, pão com manteiga, pão de queijo, leite com achocolatado, suco (em pó de uva e laranja), arroz, feijão, e strogonoff de frango, salada de tomate, sorvete de uva e de chocolate, pipoca e algodão doce.
        </p>


        <p>
          Termo de consentimento de direito de uso da imagem da criança para postagem em rede social da igreja (pode pedir ajuda pra Bruna pra ficar mais respaldado, inclusive citar o ECA Digital, se possível);
        </p>

        <hr>


        <div class="d-flex justify-content-center">
         <label class="form-check mb-4">
          <input class="form-check-input mt-1 {{ ($errors->has('agree') ? ' is-invalid' : '') }}" type="checkbox" name="agree" wire:model="agree" style="width:30px;height:30px">
          <span class="form-check-label h1 mb-0 ms-1">Li e concordo com as informações.</span>
          @error('agree')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </label>


        </div>

      </div>
    </div>

    <div class="row">
      <div class="col text-start">
        <button type="button" class="btn btn-primary me-auto btn-lg h2 {{ ($current == 1) ? 'd-none' : '' }}" wire:click="previousPage({{ $previous }})">Anterior</button>
      </div>
      <div class="col text-end">


        @if($current == 3)
        <button type="submit" class="btn btn-primary w-100 btn-lg h2">Send data</button>
        @else
        <button type="button" class="btn btn-primary btn-lg h2" wire:click="nextPage({{ $next }})">Próximo</button>
        @endif
      </div>
    </div>

  </form>

  @else

  <h1 class="text-center">Inscrições Encerradas!</h1>

@endif

</div>

