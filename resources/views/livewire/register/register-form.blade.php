<div>

  <h1 class="dissplay-4 text-center my-ss5"><strong>EBF - Igreja do Nazareno Vila Anchieta</strong></h1>
  <h2 class="dissplay-4 text-center my-s5">Sábado - 11/07/26 - Das 09:00 às 16:00</h2>
  <h2 class="dissplay-4 text-center my-s5">(Checkin à partir as 08:30)</h2>

  @if($canRegister)

  <div>
    <ul class="steps steps-green steps-counter my-4 p-0 border-0 flex-row">
      <li class="step-item {{ $current == 1 ? 'active' : '' }} "><span class="sh1">Responsável</span></li>
      <li class="step-item {{ $current == 2 ? 'active' : '' }} "><span class="sh1">Dados da Criança</span></li>
      <li class="step-item {{ $current == 3 ? 'active' : '' }} "><span class="sh1">Restrições Alimentares</span></li>
      <li class="step-item {{ $current == 4 ? 'active' : '' }} "><span class="sh1">Confirmação</span></li>
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
            <label class="form-label h2 ('mainName') }}">Nome do Responsável</label>
            <x-form.input-text class="form-control-lg" type="text" name="form.name" wire:model="form.name" />
          </div>

          <div class="col-sm-12 col-md-12">
            <label class="form-label h2 ('mainEmail') }}">Email do Responsável</label>
            <x-form.input-text class="form-control-lg" type="data" name="form.email" wire:model="form.email" />
            <span class="mt-1"></span>

          </div>


          <div class="col-sm-12 col-md-12">
            <label class="form-label h2 ('mainPhone') }}">Telefone/WhatsApp do Responsável</label>
            <x-form.input-text class="form-control-lg" type="data" name="form.phone" wire:model="form.phone" />
          </div>

        </div>
      </div>
    </div>

    <div class="card mb-4 {{ $current !== 2 ? 'd-none' : '' }}">
      <div class="card-header">
        <h1 class="m-0 ">Dados da criança</h1>
      </div>
      <div class="card-body">


         <div class="alert alert-warning alert-important">
           <strong>Atenção:</strong> Menores de 6 anos deverão permanecer acompanhados, durante todo o evento, por um responsável maior de idade.;
        </div>


        <div class="row row-cards mb-3">
          <div class="col-md-12">
            <label class="form-label h2 ('name') }}">Nome da criança</label>
            <x-form.input-text class="form-control-lg" type="text" name="form.childname" wire:model="form.childname" />
          </div>
          <div class="col-sm-12 col-md-4">
            <label class="form-label h2 ('birthdate') }}">Data de Nascimento</label>
            <x-form.input-text class="form-control-lg" type="date" name="form.childbirthdate" wire:model="form.childbirthdate" wire:blur="getAge()" />
          </div>
          <div class="col-sm-12 col-md-4">
            <label class="form-label h2 ('age') }}">Idade</label>
            <x-form.input-text class="form-control-lg" type="number" name="form.childage" wire:model="form.childage" />
          </div>
          <div class="col-sm-12 col-md-4">
            <label class="form-label h2 ('gender') }}">Gênero</label>
            <x-form.select-gender class="form-control-lg" type="data" name="form.childgender" wire:model="form.childgender" />
          </div>

          <div class="col-sm-12 col-md-12">
            <label class="form-label h2 ('church') }}">Igreja/Religião que a criança participa</label>
            <x-form.input-text class="form-control-lg" type="data" name="form.childchurch" wire:model="form.childchurch" />
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-4 {{ $current !== 3 ? 'd-none' : '' }}">
      <div class="card-header">
        <h1 class="m-0 ">Confirmação</h1>
      </div>
      <div class="card-body">

        <h4><strong>Ciência e Alertas Alimentares</strong></h4>
        <p>Estou ciente de que o cardápio do evento contará com os seguintes itens:</p>
        <ul>
          <li>Bolo de chocolate</li>
          <li>Bolo de cenoura</li>
          <li>Pão com manteiga</li>
          <li>Pão de queijo</li>
          <li>Leite com achocolatado</li>
          <li>Suco de uva e laranja (artificial)</li>
          <li>Arroz</li>
          <li>Feijão</li>
          <li>Strogonoff de frango</li>
          <li>Salada de tomate</li>
          <li>Sorvete (uva e chocolate)</li>
          <li>Pipoca</li>
          <li>Algodão-doce</li>
        </ul>

        <p>Comprometo-me a informar à organização caso o participante possua alguma restrição ou alergia alimentar severa.</p>

        <label class="form-label h2 ('church') }}">A criança possui alguma alergia ou restrição alimentar? Se sim, qual?</label>
        <textarea class="form-control form-control-lg" rows="4" type="data" name="form.food_restriction" wire:model="form.food_restriction"></textarea>
      </div>
    </div>

    <div class="card mb-4 {{ $current !== 4 ? 'd-none' : '' }}">
      <div class="card-header">
        <h1 class="m-0 ">Confirmação</h1>
      </div>
      <div class="card-body">
        <h4><strong>Termo de Consentimento para Uso de Imagem</strong></h4>
        <p>
          Autorizo expressamente a Igreja a utilizar e publicar fotos e vídeos da criança em suas redes sociais oficiais e materiais de divulgação religiosa. Esta autorização é voluntária, gratuita e respeita as diretrizes de proteção à infância e juventude previstas no Estatuto da Criança e do Adolescente (ECA).
        </p>
        <hr>
        <div class="d-flex justify-content-center">
           <label class="form-check mb-4">
            <input class="form-check-input mt-1 {{ ($errors->has('form.agree') ? ' is-invalid' : '') }}" type="checkbox" name="form.agree" wire:model="form.agree" style="width:30px;height:30px">
            <span class="form-check-label h1 mb-0 ms-1">Li e concordo com as informações.</span>
            @error('form.agree')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </label>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col text-start">
        <button type="button" class="btn btn-primary me-auto btn-lg h2 {{ ($current == 12) ? 'd-none' : '' }}" wire:click="previousPage({{ $previous }})">Anterior</button>
      </div>
      <div class="col text-end">
        @if($current == 4)
        <button type="submit" class="btn btn-primary w-100 btn-lg h2">Enviar</button>
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

