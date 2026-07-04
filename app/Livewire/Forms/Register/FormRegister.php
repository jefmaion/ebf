<?php

namespace App\Livewire\Forms\Register;

use App\Mail\WelcomeRegister;
use App\Models\Register;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FormRegister extends Form
{

    public $_step = null;

    public ?Register $register = null;

    public $name;
    public $email;
    public $phone;
    public $childname;
    public $childbirthdate;
    public $childage;
    public $childgender;
    public $childchurch;
    public $food_restriction;
    public bool $agree = false;

    public function rules() {

        $steps = [
            1 => ['name','email'],
            2 => ['childname','childbirthdate','childage','childgender'],
            4 => ['agree']
        ];

        $rules = [
            'name' => ['required'],
            'email' => ['required'],
            'childname' => ['required', Rule::unique('registers')->where('name', $this->name)->where('childname', $this->childname)->ignore($this->register?->id)],
            'childbirthdate' => ['required'],
            'childage' => ['required'],
            'childgender' => ['required'],
            'agree' => ['accepted', Rule::unique('registers')->where('name', $this->name)->where('childname', $this->childname)->ignore($this->register?->id)],
        ];

        if(empty($this->_step)) {
            return $rules;
        }

        if(!isset($steps[$this->_step])) {
            return  [
                'name' => 'required'
            ];
        }

        return array_intersect_key($rules, array_flip($steps[$this->_step]));

    }

     protected function messages()
    {
        return [
            'agree.accepted' => 'Você precisa aceitar os termos para finalizar',
        ];
    }

    public function getAgeGroupColor($age): string
    {
        $idade = $age;

        return match (true) {
            $idade <= 7  => 'bg-danger text-white',   // Berçário / Maternal (Ex: Vermelho)
            $idade <= 9  => 'bg-warning text-dark',   // Infantil (Ex: Amarelo)
            $idade <= 11  => 'bg-success text-white',  // Juniores 1 (Ex: Verde)
            default      => 'bg-secondary text-white' // Outros / Adolescentes
        };
    }


    public function store() {

        $this->_step = null;
        $this->validate();

        $data = $this->all();

        $register = Register::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'childname' => $data['childname'],
            'childbirthdate' => $data['childbirthdate'],
            'childage' => $data['childage'],
            'childgender' => $data['childgender'],
            'childchurch' => $data['childchurch'],
            'agree' => $data['agree'],
            'food_restriction' => $data['food_restriction'],

            'bracelet_color' => $this->getAgeGroupColor($data['childage']),

            'hash' => Str::uuid()
        ]);


        // Storage::disk('public')->put("qrcodes/{$register->hash}.png",QrCode::format('png')->size(400)->margin(2)->generate($register->hash));


        Mail::to($register->email)->send(
            new WelcomeRegister(
                $register->name,
                $register->childname,
                $register->hash // O ID que a sua impressora MPT vai ler depois!
            )
        );

        return $register;

    }

    public function populate(Register $register) {


        $this->register = $register;

        $this->name = $register->name;
        $this->email = $register->email;
        $this->phone = $register->phone;

        $this->childname = $register->childname;
        $this->childage = $register->childage;
        $this->childbirthdate = $register->childbirthdate;
        $this->childgender = $register->childgender;
        $this->childchurch = $register->childchurch;
        $this->food_restriction = $register->food_restriction;

        $this->agree = $register->agree;
    }

    public function update() {

        $this->validate();

        $data = $this->all();

        $this->register->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'childname' => $data['childname'],
            'childbirthdate' => $data['childbirthdate'],
            'childage' => $data['childage'],
            'childgender' => $data['childgender'],
            'childchurch' => $data['childchurch'],
            'food_restriction' => $data['food_restriction']
        ])->update();


    }
}
