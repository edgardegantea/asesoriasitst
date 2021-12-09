<?php

namespace App\Http\Controllers;
use App\models\Asesorias;
use App\models\Docentes;
use App\models\User;
use App\models\solicituasesorias;
use Illuminate\Http\Request;
use App\Models\vistas\VistaValidacionAlumno;
use Illuminate\Support\Facades\DB;
use Mail;

class AsesoriaAlumnoController extends Controller
{
    

    public function edit($id)
    {
       

        $Asesorias = VistaValidacionAlumno::where('idSolicitud', $id)->get();
        $ConsultaNotifDocente=solicituasesorias::Select('VisualizacionAlumno')->Where('idSolicituAsesorias',$id)->get();

        if($ConsultaNotifDocente[0]['VisualizacionAlumno'] == 0  or $ConsultaNotifDocente[0]['VisualizacionAlumno'] == null){
        
               $ConsultaidDocente= Asesorias::Select('Docentes_id')->Where('idSolicitud', $id)->get();
               $idDocente = $ConsultaidDocente[0]['Docentes_id'];
               $ConsultaIdUsuario= Docentes::Select('id_user')->Where('idDocentes', $idDocente)->get();
               $idUsuario = $ConsultaIdUsuario[0]['id_user'];
               $consultaCorreo= User::Select('email')->Where('id_user',$idUsuario)->get();
               $correo= $consultaCorreo[0]['email'];
       
                   $dataDocente =[
                     'subject' => 'Asignación de asesoría',
                   //  'name' => $nom->nombre.$nom->apellido,
                     'email' => $correo,
                     'content' => 'Por medio de la presente se le hace de su conocimiento que se le asignado como asesor para impartir una asesoría favor de consultar la aplicación para más detalles.'
                 ];
                 
                 $this->sendEmail($dataDocente);
                 DB::table('solicituasesorias')->where('idSolicituAsesorias', $id)->update(['VisualizacionAlumno' => 1]);
        }




        return view ('livewire.alumnos.asesorias.editValidate', compact('Asesorias'));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      
       $datos=$request->except('_method','_token');
       
       Asesorias::where('idAsesorias','=',$id)->update($datos);

       toast('Asesoria Validada','success')->position('top-end');

        return back()->withInput();
    }
    public function sendEmail($data)
    {

        Mail::send('email.email-template', $data, function($message) use ($data) {
          $message->to($data['email'])
          ->subject($data['subject']);
        });
        toast('Se ha notificado a los implicados a la asesoría','success');

        return redirect()->route('ProgramacionAsesoria');
    }
}
