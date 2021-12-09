<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carreras;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carreras::create([
            'nombreCarrera' => 'Ingeniería en Industrias Alimentarias',
        ]);    
        Carreras::create([
            'nombreCarrera' => 'Ingeniería Industrial',

        ]);    
        Carreras::create([
            'nombreCarrera' => 'Ingenieria en Sistemas Computacionales',

        ]);   
        Carreras::create([
            'nombreCarrera' => 'Ingeniería Mecatrónica',
        ]);    
        Carreras::create([
            'nombreCarrera' => 'Ingeniería Informática',

        ]);    
        Carreras::create([
            'nombreCarrera' => 'Ingeniería en Gestión Empresarial',

        ]);   

    }
}
