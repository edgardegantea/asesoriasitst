<?php

namespace App\Http\Livewire\DivisionInformatica\Solicitudes;
use  App\Models\vistas\Revision_Solicitudes as Revision;
use App\Models\Estudiantes;
use App\Models\Docentes;
use App\Models\solicituasesorias;
use App\Models\Asesorias;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class ProgramacionAsesorias extends Component
{
    public $idRevicion, $Exist_Asesoria = null, $idDocente,$semanas, $HoraInicial, $HoraFinal, $fechaAsesoria,$docentes,$estudiantes, $idEstudiantes, $vista, $datosEst, $nombre, $apellidos;
  
    use WithPagination;
    public $modal = false;

    public $vistaDH , $selectDocente= null, $selectHD = null;

    public function render()
    {
    /*    if($this->idRevicion != null){
        $this->Exist_Asesoria = Asesorias::Where('idSolicitud', $this->idRevicion);
         }*/
         
        $vistaRE = Revision::Where('estado','1')->
        OrWhere('estado','2')
        ->orWhere('estado','3')->orderBy('estado', 'ASC')->get();

        $this->docentes = Docentes::all();

        

        return view('livewire.division-informatica.solicitudes.programacion-asesorias', compact('vistaRE'));
    }




    public function crear(){
 
        $this->abrirModal();
    }
    public function abrirModal(){
        $this->modal = true;
    }   
    public function cerrarModal(){
        $this->programacion = false;
        $this->selectDocente = false;
        $this->selectHD = false;


    }
    
    public function limpiar(){
        $this->fechaAsesoria = ' ';
        $this->semanas = ' ';
        $this->HoraInicial = ' ';
        $this->HoraFinal = ' ';
        $this->idEstudiantes = ' ';
        $this->idDocentes = ' ';


    }

    public function editar($id){


        $idEstudiante = solicituasesorias::select('idEstudiantes')->where('idSolicituAsesorias',$id)->get();
        $variableidE= $idEstudiante[0]['idEstudiantes'];
       // $Revision = Revision::findOrFail($variableidE);
        $this->idRevicion = $id;
        $this->idEstudiantes = $variableidE;
        $estudiante = Estudiantes::select('nombre', 'apellido')->where('idEstudiantes', $variableidE)->get();
       $this->nombre = ($estudiante[0]['nombre']." ".$estudiante[0]['apellido']);

        $this->vista = DB::select('CALL view_horario_Extrescolares('.$variableidE.')');

        $this->abrirModal();

    }


}
