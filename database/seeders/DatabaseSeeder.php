<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\Register;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'  => 'Jefferson',
            'email' => 'jefmaion@hotmail.com',
            'password' => Hash::make('Jeffer$on85')
        ]);


        // for($i=0;$i<=10;$i++) {

        //     $birth = fake()->dateTimeBetween('-12 years', 'now')->format('Y-m-d');


        //    Register::create([
        //         'name'             => fake()->name(),
        //         'email'            => fake()->unique()->safeEmail(),
        //         'phone'            => fake()->cellphone(), // Gera formato (XX) 9XXXX-XXXX (se configurado pt_BR)
        //         'childname'        => fake()->name(),
        //         'childbirthdate'   => $birth,
        //         'childage'         => Carbon::parse($birth)->age,
        //         'childgender'      => fake()->randomElement(['M', 'F']),
        //         'childchurch'      => fake()->company(),
        //         'agree'            => true,                              // Aceite dos termos fixado em verdadeiro
        //         'food_restriction' => fake()->randomElement(['Nenhuma', 'Lactose', 'Glúten', 'Amendoim']),
        //         'hash'             => Str::uuid(),
        //         'bracelet_color' => fake()->randomElement(['bg-purple-lt', 'bg-green-lt', 'bg-orange-lt']),
        //     ]);



        // }

    }
}
