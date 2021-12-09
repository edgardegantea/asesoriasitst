<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\solicituasesorias;
use App\Models\Estudiantes;
use App\Models\Docentes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Mail;

class AsesoriaController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //->except('_method','_token')
        $datos=array_values($request->except('_token'));
        print_r( $datos);
        DB::select('call calendarizacionAsesoria(?,?,?,?,?,?,?)',$datos);

       $idasesoria = $request->input('idAsesoria');
        $datosSol = solicituasesorias::Where('idSolicituAsesorias', $idasesoria)->get();

        $idEstudiantes = $request->input('idEstudiantes');
        $idusuarioEstudante = Estudiantes::select('id_user')->where('idEstudiantes',$idEstudiantes)->get();
        foreach($idusuarioEstudante as $id){ $variableUE= $id->id_user;}
       
        $correoUserEstudiante = User::select('email')->where('id_user', $variableUE)->get();


        $idDocentes = $request->input('idDocentes');
        $idusuarioDocente= Docentes::select('id_user')->where('idDocentes',$idDocentes)->get();
        foreach($idusuarioDocente as $id){ $variableUD= $id->id_user;}

        $correoUserDocente= User::select('email')->where('id_user', $variableUD)->get();
        
        foreach($correoUserEstudiante as $correo){
        $dataAlumno =[
          'subject' => 'Autorización de asesoría',
        //  'name' => $nom->nombre.$nom->apellido,
          'email' => $correo->email,
          'content' => 'Por medio de la presente se le hace de su conocimiento que su solicitud de asesoria ha si aprovada favor de comprobarlo mediante la aplicación.'
      ];
      }
      $this->sendEmail($dataAlumno);


        return redirect()->route('ProgramacionAsesoria');



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
