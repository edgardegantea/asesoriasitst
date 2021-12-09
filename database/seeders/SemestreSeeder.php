<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semestres;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semestres::create([
            'numeroSemestre' => '1',

        ]);    
        Semestres::create([
            'numeroSemestre' => '2',

        ]);    
        Semestres::create([
            'numeroSemestre' => '3',

        ]);    
        Semestres::create([
            'numeroSemestre' => '4',

        ]);    
        Semestres::create([
            'numeroSemestre' => '5',

        ]);    
        Semestres::create([
            'numeroSemestre' => '6',

        ]);    
        Semestres::create([
            'numeroSemestre' => '7',

        ]);    
    }
}
