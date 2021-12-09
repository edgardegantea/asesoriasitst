<?php

namespace App\Http\Livewire\Docentes\Asesorias;
use App\models\Asesorias as ase;
use App\models\solicituasesorias as solicitud;
use App\models\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Asesorias extends Component
{
    public $vista;
    public function render()
    {
        $idusuario = auth()->id();
        $IdDocente = Docentes::select('idDocentes')->where('id_user', $idusuario)->get();
        $this->vista = DB::select('CALL View_asesoriasDocentes('.$IdDocente[0]['idDocentes'].')');
    return view('livewire.docentes.asesorias.asesorias');

    }
}
