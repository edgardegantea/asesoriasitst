<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modalidades;

class ModalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modalidades::create([
            'nombreModalidad' => 'Escolarizado',

        ]);    
        Modalidades::create([
            'nombreModalidad' => '*Escolarizado',

        ]);    
        Modalidades::create([
            'nombreModalidad' => 'Distancia',

        ]);       
    }
}
