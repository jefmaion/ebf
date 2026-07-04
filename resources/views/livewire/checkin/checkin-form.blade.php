

          <!-- <img src="{{ asset('storage/qrcodes/'.$register->hash.'.png') }}" class="mb-4" width="200px" alt="QR Code"> -->

          <div class="row row-cards mb-3">
            <div class="col-md-12">
              <label class="form-label">Nome da criança</label>
              <x-form.input-text class="" type="text" name="form.childname" wire:model="form.childname" />
            </div>
            <div class="col-sm-12 col-md-4">
              <label class="form-label">Data de Nascimento</label>
              <x-form.input-text class="" type="date" name="form.childbirthdate" wire:model="form.childbirthdate" wire:blur="getAge()" />
            </div>
            <div class="col-sm-12 col-md-4">
              <label class="form-label">Idade</label>
              <x-form.input-text class="" type="number" name="form.childage" wire:model="form.childage" />
            </div>
            <div class="col-sm-12 col-md-4">
              <label class="form-label">Sexo</label>
              <x-form.select-gender name="form.childgender" wire:model="form.childgender" />
            </div>

            <div class="col-sm-12 col-md-12">
              <label class="form-label">Igreja que a criança participa</label>
              <x-form.input-text class="" name="form.childchurch" wire:model="form.childchurch" />
            </div>

            <div class="col-md-12">
              <label class="form-label">A criança possui alguma alergia ou restrição alimentar? Se sim, qual?</label>
              <textarea class="form-control" rows="3" type="data" name="form.food_restriction" wire:model="form.food_restriction"></textarea>
            </div>



            
          </div>

          <div class="row row-cards mt-3">
            <div class="col-md-12">
              <label class="form-label ('mainName') }}">Responsável</label>
              <x-form.input-text class="" type="text" name="form.name" wire:model="form.name" />
            </div>

            <div class="col-sm-12 col-md-8">
              <label class="form-label ('mainEmail') }}">Email </label>
              <x-form.input-text class="" type="data" name="form.email" wire:model="form.email" />
              <span class="mt-1"></span>

            </div>


            <div class="col-sm-12 col-md-4">
              <label class="form-label ('mainPhone') }}">Telefone/WhatsApp</label>
              <x-form.input-text class="" type="data" name="form.phone" wire:model="form.phone" />
            </div>

          </div>

          

