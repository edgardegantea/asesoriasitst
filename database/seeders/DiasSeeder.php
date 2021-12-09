<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dias;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dias::create([
            'descripcion' => 'Lunes',

        ]);    
        Dias::create([
            'descripcion' => 'Martes',

        ]);    
        Dias::create([
            'descripcion' => 'Miércoles',

        ]);    
        Dias::create([
            'descripcion' => 'Jueves',

        ]);    
        Dias::create([
            'descripcion' => 'Viernes',

        ]);    
        Dias::create([
            'descripcion' => 'Sabado',

        ]);    

    }
}
