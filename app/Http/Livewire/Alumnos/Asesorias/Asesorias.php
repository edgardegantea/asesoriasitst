<?php

namespace App\Http\Livewire\Alumnos\Asesorias;

use Livewire\Component;
use App\models\Estudiantes;
use Illuminate\Support\Facades\DB;

class Asesorias extends Component
{
    public $vista;
    public function render()
    {
        $idusuario = auth()->id();
        $idEstudiantes = Estudiantes::select('idEstudiantes')->where('id_user', $idusuario)->get();
        $this->vista = DB::select('CALL view_Asesorias_Alumnos('.$idEstudiantes[0]['idEstudiantes'].')');

        return view('livewire.alumnos.asesorias.asesorias');
    }
    public function cancelarAsesoria($id){
        DB::table('solicituasesorias')->update([ 'estado' => '5' ]);
        redirect('/Asesorias-alumno');
    }
}
