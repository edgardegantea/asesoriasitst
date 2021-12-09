<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Extraescolares;

class extraescolaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Extraescolares::create([
            'nombreExtraescolar' => 'Rondalla',

        ]);    
        Extraescolares::create([
            'nombreExtraescolar' => 'Pesas y aparatos',

        ]);    
        Extraescolares::create([
            'nombreExtraescolar' => 'Basquetboll',

        ]);      
        Extraescolares::create([
            'nombreExtraescolar' => 'Futbol',

        ]);    
        Extraescolares::create([
            'nombreExtraescolar' => 'Danza',

        ]);    
        Extraescolares::create([
            'nombreExtraescolar' => 'Teatro',

        ]);   
    }
}
