<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vistas\VistaValidaciones;

class AsesoriaDivisionController extends Controller
{
    public function edit($id)
    {
        $Asesorias = VistaValidaciones::where('idSolicitud', $id)->get();
 
        return view ('livewire.division-informatica.asesorias-programadas.revision-validacion', compact('Asesorias'));
    }

}
