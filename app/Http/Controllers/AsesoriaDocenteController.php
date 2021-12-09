<?php

namespace App\Http\Controllers;
use App\models\Asesorias;
use App\models\solicituasesorias as solicitud;
use App\models\Docentes;
use App\models\vistas\VistaValidacionDocente;
use Illuminate\Http\Request;

class AsesoriaDocenteController extends Controller
{

    public function edit($id)
    {
        $Asesorias = VistaValidacionDocente::where('idSolicitud', $id)->get();
 
        return view ('livewire.docentes.asesorias.editValidate', compact('Asesorias'));
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

     
        return back()->withInput();
    }

}
