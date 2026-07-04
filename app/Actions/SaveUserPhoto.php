<?php

namespace App\Actions;

use App\Models\Register;

use Illuminate\Support\Facades\Storage;

class SaveUserPhoto
{

    public static function run(Register $register, $photo)
    {
       // 1. Remove o cabeçalho do Base64 (ex: "data:image/jpeg;base64,")
            // Deixando apenas a string de dados pura
            $dadosImagem = preg_replace('#^data:image/\w+;base64,#i', '', $photo);

            // 2. Decodifica a string Base64 transformando-a em bytes reais da imagem
            $imagemDecodificada = base64_decode($dadosImagem);

            // 3. Define um nome único para o arquivo (ex: usando o ID ou UUID)
            $nomeArquivo = "checkins/".$register->id.time().".jpg";


            if(!empty($register->photo)) {
                Storage::disk('public')->delete($register->photo);
            }

            // 4. Salva fisicamente no disco 'public' (storage/app/public/checkins/...)
            Storage::disk('public')->put($nomeArquivo, $imagemDecodificada);


            $register->update([
                'photo' => $nomeArquivo, // Salvando a string Base64 direto na tabela
            ]);

            return $register;

    }
}
