<?php

namespace App\Livewire\Checkin;

use App\Actions\PrintLabel;
use App\Models\Register;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Checkin extends Component
{

    public ?Register $register = null;

    public $takePhoto = false;


    #[On('make-checkin')]
    #[On('qrcode-loaded')]
    public function select(Register $register) {
        $this->register = $register;
        $this->dispatch('show-modal', modal:'modal-show-checkin');

    }

     public function getPhoto() {

        $this->takePhoto = (!$this->takePhoto);
    }

    #[On('photo-result')]
    public function setPhoto($photo)
    {


        // Aqui você já tem acesso ao $this->fotoCapturada preenchido


            // 1. Remove o cabeçalho do Base64 (ex: "data:image/jpeg;base64,")
            // Deixando apenas a string de dados pura
            $dadosImagem = preg_replace('#^data:image/\w+;base64,#i', '', $photo);

            // 2. Decodifica a string Base64 transformando-a em bytes reais da imagem
            $imagemDecodificada = base64_decode($dadosImagem);

            // 3. Define um nome único para o arquivo (ex: usando o ID ou UUID)
            $nomeArquivo = "checkins/".$this->register->id.time().".jpg";


            if(!empty($this->register->photo)) {
                Storage::disk('public')->delete($this->register->photo);
            }

            // 4. Salva fisicamente no disco 'public' (storage/app/public/checkins/...)
            Storage::disk('public')->put($nomeArquivo, $imagemDecodificada);


            $this->register->update([
                'photo' => $nomeArquivo, // Salvando a string Base64 direto na tabela
            ]);

            $this->register->refresh();

            $this->takePhoto = false;

            $this->dispatch('$refresh');

    }

    public function doCheckin() {

        $this->register->update(['checkin_date' => now(), 'user_id_checkin' => auth()->user()->id]);
        $this->dispatch('hide-modal', modal:'modal-show-checkin');
        $this->dispatch('checkin-changed');
    }

    public function print() {
        PrintLabel::run($this->register);



    }


    public function render()
    {
        return view('livewire.checkin.checkin');
    }
}
