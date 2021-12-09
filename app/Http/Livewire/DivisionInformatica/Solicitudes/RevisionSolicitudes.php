<?php

namespace App\Http\Livewire\DivisionInformatica\Solicitudes;

use App\Models\vistas\solicitudes_estudiantes as Solicitudes;
use  App\Models\vistas\Revision_Solicitudes as Revision;
use  App\Models\solicituasesorias;
use App\Models\Notificaciones as notif;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class RevisionSolicitudes extends Component
{
    public  $notificacion,$notif, $estado, $numeroControl, $idSolicitud, $estudiante, $justificacion, $materiaSolicitada;
    use WithPagination;
    public $modal = false;
    public $visualizar = false;

    public function render()
    {


        $vistaRE = Revision::where('estado', '4')->orwhere('estado', '2')->paginate(5);

        return view('livewire.division-informatica.solicitudes.revision-solicitudes', compact('vistaRE'));
    }



    public function crear(){
        $this->abrirModal();
    }
    public function abrirModal(){
        $this->modal = true;
    }   
    public function cerrarModal(){

        $this->modal = false;
    }
    public function limpiar(){

    }

    public function abrirview(){

        $this->visualizar = true;
    }   
    public function cerrarview(){
        $this->visualizar = false;
    }



    public function view($id){
        $this->cerrarModal();
        $Revision = Revision::findOrFail($id);
        $this->idSolicitud= $id;
        $this->numeroControl = $Revision->numeroControl;
        $this->estudiante = $Revision->estudiante;
        $this->materiaSolicitada =$Revision->materiaSolicitada;
        $this->justificacion =$Revision->justificacion;
        $this->estado =$Revision->estado;

        $this->abrirview();
    }

    
    public function editar($id){
        $this->cerrarview();
        $solicitud = solicituasesorias::findOrFail($id);
        $this->idSolicitud= $id;
        $this->estado = $solicitud->estado;


        $this->abrirModal();
    }

    public function actualizar(){
        
        solicituasesorias::where('idSolicituAsesorias', $this->idSolicitud)->update([
            'idSolicituAsesorias' => $this->idSolicitud,
            'estado' => $this->estado,
        ]);
        if($this->estado == 'Autorizada'){
            $datos_notif = ([
                'tipo' => 'Autorización',
                'idSolicituAsesorias' => $this->idSolicitud,
         
        
            ]);
        
            notif::create($datos_notif);
        }
       toast('Tú registro fue actualizado correctamente','success');

       return redirect('/Revision-Asesoria');

    }
    public function notifydelete($id){
        notif::find($id)->delete();

    }
 
}
