<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Register extends BaseModel
{
    public $guarded = ['id'];

     protected $casts = [
        'email_verified_at' => 'datetime',
        'checkin_date' => 'datetime',
        'checkout_date' => 'datetime',
        'childbirthdate' => 'date',
    ];

    /** @use HasFactory<\Database\Factories\RegisterFactory> */
    use HasFactory;

    public function qrCode() {
          // Gera o PNG bruto na memória
        $pngData = QrCode::format('png')
            ->size(400)
            ->margin(2)
            ->generate($this->hash);

        // Converte os bytes do PNG para uma string Base64 limpa
        $base64 = base64_encode($pngData);

        // Retorna o Data URI pronto para uso na tag HTML <img>
        return "data:image/png;base64,{$base64}";
    }

    public function bracelet(): string
    {
        $idade = $this->childage;

        return match (true) {
            $idade <= 7  => 'green',   // Berçário / Maternal (Ex: Vermelho)
            $idade <= 9  => 'blue',   // Infantil (Ex: Amarelo)
            $idade <= 11  => 'orange',  // Juniores 1 (Ex: Verde)
            default      => 'secondary' // Outros / Adolescentes
        };
    }

    public function photo() {
        return asset('storage/' . $this->photo);
    }

    public function respShortName() {
        $first = explode(' ', trim($this->name))[0];
        $parts = preg_split('/\s+/', trim($this->name));
        $last = end($parts);

        return $first .' '.$last;
    }

    public function childShortName() {
        $first = explode(' ', trim($this->childname))[0];
        $parts = preg_split('/\s+/', trim($this->childname));
        $last = end($parts);

        return $first .' '.$last;
    }
}
