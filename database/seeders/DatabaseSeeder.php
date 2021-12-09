<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Estudiantes;
use App\Models\Docentes;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    $this->call(RoleSeeder::class);    
    $this->call(CarrerasSeeder::class);    
    $this->call(SemestreSeeder::class);    
    $this->call(DiasSeeder::class);    
    $this->call(ModalidadesSeeder::class);    
    $this->call(MateriaSeeder::class);    
    $this->call(extraescolaresSeeder::class);    

        User::create([
            'id_user' => 1,
            'name'=>'Admin',
            'numeroControl'=>'17TEADMI',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('123456789'),
        ])->assignRole('Admin');

        User::create([
            'id_user' => 2,
            'name'=>'Division',
            'numeroControl'=>'DIVISION',
            'email'=>'Division@gmail.com',
            'password'=>Hash::make('123456789'),
        ])->assignRole('Division');
        

        User::create([
            'id_user' => 3,
            'name'=>'Maria',
            'numeroControl'=>'17TE0002',
            'email'=>'Maria@gmail.com',
            'password'=>Hash::make('123456789'),
        ])->assignRole('Docente');

        Docentes::create([
            'idDocentes' => 1,
            'nombre'=>'María',
            'apellidos'=>'jimenez Mendez',
            'id_user'=>3,
        ]);

        User::create([
            'id_user' => 4,
            'name'=>'Itza',
            'numeroControl'=>'17TE0001',
            'email'=>'Itza@gmail.com',
            'password'=>Hash::make('123456789'),
        ])->assignRole('Docente');

        Docentes::create([
            'idDocentes' => 2,
            'nombre'=>'Itza',
            'apellidos'=>'Moralez Vazquez',
            'id_user'=>4,
        ]);

        User::create([
            'id_user' => 5,
            'name'=>'isaac',
            'numeroControl'=>'17TE0003',
            'email'=>'isaac@gmail.com',
            'password'=>Hash::make('123456789'),
        ])->assignRole('Alumno');

        Estudiantes::create([
            'idEstudiantes' => 1,
            'nombre'=>'Isaac',
            'apellido'=>'Salomé Gandara',
            'grupo'=>'A',
            'Carreras_id'=>'5',
            'Semestres_id'=>'7',
            'Modalidades_id'=>'1',
            'id_user'=>'5',
        ]);

        User::create([
            'id_user' => 6,
            'name'=>'joel',
            'numeroControl'=>'17TE0004',
            'email'=>'joel@gmail.com',
            'password'=>Hash::make('123456789'),
        ])->assignRole('Alumno');

        Estudiantes::create([
            'idEstudiantes' => 2,
            'nombre'=>'Joel Said',
            'apellido'=>'Santana Muñoz',
            'grupo'=>'A',
            'Carreras_id'=>'5',
            'Semestres_id'=>'5',
            'Modalidades_id'=>'1',
            'id_user'=> 6,
        ]);


        // \App\Models\User::factory(10)->create();
       
    }
}
