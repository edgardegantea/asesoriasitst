<?php

namespace App\Http\Livewire\Alumnos\Solicitud;

use Livewire\Component;
use App\Models\vistas\solicitudes_estudiantes as Solicitudes;
use App\Models\solicituasesorias as sol;
use App\Models\Estudiantes;
use App\Models\User;
use App\Models\Materia;
use App\Models\Notificaciones as notif;
use App\Models\vistas\vistanotifAuto;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Mail;


class SolicitarAsesoria extends Component
{
    use WithPagination;
    public  $notificacion,$notif, $estudiante, $idEstudiante, $materia, $idSolicituAsesorias, $justificacion, $estado, $idEstudiantes, $idMateria;
    public $modal = false;

    protected $rules = [
        'justificacion' => 'required',
        'idMateria' => 'required',
 

    ];
    protected $messages = [
        'justificacion.required' => 'La justificación no puede estar vacío.',
        'idMateria.required' => 'Seleccione una materia',


    ];

    public function render()
    {
      

        $idusuario = auth()->id();
        $idEstudiante = Estudiantes::select('idEstudiantes')->where('id_user',$idusuario)->get();
        $variableidE= $idEstudiante[0]['idEstudiantes'];

        $this->notificacion = vistanotifAuto::Where('id_user',$idusuario)->get();

       $vistaSA = Solicitudes::where('idEstudiantes', $variableidE)->paginate(5);
        $this->estudiante = Estudiantes::all();
        $this->materia = Materia::all();

        return view('livewire.alumnos.solicitud.solicitar-asesoria', compact('vistaSA'));
    }
    public function limpiar(){
        $this->justificacion = ' ';
        $this->idMateria = ' ';
    }

    public function crear(){
        $this->limpiar();
        $this->abrirModal();
    }
    public function abrirModal(){
        $this->modal = true;
    }   
    public function cerrarModal(){
        $this->modal = false;
    }

    public function editar($id){
        $Solicitud = Solicitudes::findOrFail($id);

        $this->idSolicituAsesorias= $id;
        $this->justificacion = $Solicitud->nombreMateria;
        $this->estado = $Solicitud->Carreras_idCarreras1;
        $this->idEstudiantes = $Solicitud->Semestres_idSemestres;
        $this->idMateria = $Solicitud->Semestres_idSemestres;

        $this->abrirModal();
    }

    public function borrar($id){
        notif::select('idNotificaciones')->where('idSolicituAsesorias',$id)->delete();
        sol::find($id)->delete();
        session()->flash('message', 'Registro eliminado correctamente.');

    }

    Public function guardar(){
        $this->validate();

        $idusuario = auth()->id();
        $idEstudiante = Estudiantes::select('idEstudiantes')->where('id_user',$idusuario)->get();
        $variableidE= $idEstudiante[0]['idEstudiantes'];

        $nombreEstudiante = Estudiantes::where('id_user', $idusuario)->get();



        sol::updateOrCreate(['idSolicituAsesorias' => $this->idSolicituAsesorias],
        [
            'justificacion' => $this->justificacion,
            'estado' =>'4',// 1= Autorizacion, 2 = Cancelada, 3 = Programada, 4 = En revision
            'idEstudiantes' =>$variableidE,
            'idMateria' =>$this->idMateria

    ]);
    $lastid = DB::table('solicituasesorias')->latest()->first();

    $datos_notif = ([
        'tipo' => 'Solicitud',
        'idSolicituAsesorias' => $lastid->idSolicituAsesorias,
 

    ]);

    notif::create($datos_notif);

    $materia = Materia::select('nombreMateria')->Where('idMateria',$this->idMateria)->get();


    foreach ($nombreEstudiante as $nom){
        foreach ($materia as $mat){

        $data =[
            'subject' => 'Solicitud de asesoría',
            'name' => $nom->nombre.$nom->apellido,
            'email' => 'isaacsalome1704@gmail.com',
            'content' => 'El alumno '.$nom->nombre.$nom->apellido.' a solicitado una asesoría para la materia '.$mat->nombreMateria
        ];
    }
    }
    $this->sendEmail($data);
        $this->idSolicituAsesorias ? toast('Tú registro fue actualizado correctamente','success') : toast('Registro Guardado con éxito','success');

        return redirect('/Solicitar-Asesoria');
    }


    public function notifydelete($id){
        notif::find($id)->delete();

    }

    public function sendEmail($data)
    {

       /* $data = [
          'subject' => $request->subject,
          'name' => $request->name,
          'email' => $request->email,
          'content' => $request->content
        ];*/

        Mail::send('email.email-template', $data, function($message) use ($data) {
          $message->to($data['email'])
          ->subject($data['subject']);
        });
        toast('Notificación enviada','success');
        return back();
    }
}
