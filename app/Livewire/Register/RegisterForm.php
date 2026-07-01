<?php

namespace App\Livewire\Register;

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\Register;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegisterForm extends Component
{

    public $max = 125;
    public $canRegister = true;

    public $next = 2;
    public $current = 1;
    public $previous = 0;

    public $name;
    public $email;
    public $phone;
    public $childname;
    public $childbirthdate;
    public $childage;
    public $childgender;
    public $childchurch;
    public $agree;

    public function mount() {

        $this->canRegister = Register::count() < $this->max;

    }

    public function rules() {

        $_rules = [
            1 => [
                'name' => ['required'],
                'email' => ['required'],
            ],

            2 => [
                'childname' => ['required', Rule::unique('registers')->where('name', $this->name)->where('childname', $this->childname)],
                'childbirthdate' => ['required'],
                'childage' => ['required'],
                'childgender' => ['required'],
            ],

            3 => [
                'agree' => ['accepted', Rule::unique('registers')->where('name', $this->name)->where('childname', $this->childname)],
            ]
        ];


        $rules = $_rules[$this->current];

        return $rules;
    }

    protected function messages()
    {
        return [
            'agree.accepted' => 'Você precisa aceitar os termos para finalizar',
        ];
    }

    public function nextPage($val) {
        $this->doValidation();
        $this->refreshPagination($val);
    }

    public function previousPage($val) {
        $this->refreshPagination($val);
    }

    public function refreshPagination($val) {
        $this->current = $val;
        $this->next = $this->current + 1;
        $this->previous = ($this->current - 1) == 0 ? 1 : $this->current - 1;
    }

    public function doValidation() {
        $this->resetValidation();
        $this->validate();
    }


    public function save() {
        $this->doValidation();


        $register = Register::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'childname' => $this->childname,
            'childbirthdate' => $this->childbirthdate,
            'childage' => $this->childage,
            'childgender' => $this->childgender,
            'childchurch' => $this->childchurch,
            'agree' => $this->agree,

            'hash' => Str::uuid()
        ]);

        Storage::disk('public')->put(
            "qrcodes/{$register->hash}.png",
            QrCode::format('png')
                ->size(400)
                ->generate($register->hash)
        );

        // enviar email
        // enviar zap

        return redirect('success');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.register.register-form');
    }
}
