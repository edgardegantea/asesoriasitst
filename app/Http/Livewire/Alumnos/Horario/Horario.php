<?php

namespace App\Http\Livewire\Alumnos\Horario;

use App\Models\Horarios;
use App\Models\HorariosAlumnos;
use App\Models\vistas\Vista_HorarioExtrescolar;
use App\Models\vistas\vista_HorarioAlumnos;
use App\Models\Dias;
use App\Models\Extraescolares;

use App\Models\HorarioExtraescolares;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Estudiantes;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Horario extends Component
{
    public $i=7, $var;
    public $search;
    public $sort='idHorarioExtraescolar';
    public $direction='asc';
    use WithPagination;
    public $vista, $iddia, $idHorarioExtraescolar ,$idExtraescolar, $extraescolares , $HoraInicial, $HoraFinal, $idEstudiantes, $horarios, $dias, $consideraciones;		
    public $modal = false;
    protected $rules = [
        'idExtraescolar' => 'required',
        'iddia' => 'required',
        'HoraInicial' => 'required',
        'HoraFinal' => 'required',

    ];
    protected $messages = [
        'idExtraescolar.required' => 'La justificación no puede estar vacío.',
        'iddia.required' => 'La justificación no puede estar vacío.',
        'HoraInicial.required' => 'La justificación no puede estar vacío.',
        'HoraFinal.required' => 'La justificación no puede estar vacío.',


    ];
    
    public function render()
    {
        $idusuario = auth()->id();
      //  $semes = Estudiantes::select('Semestres_id')->where('id_user',$idusuario)->get();
        $idEstudiante = Estudiantes::select('idEstudiantes')->where('id_user',$idusuario)->get();
        $variableidE= $idEstudiante[0]['idEstudiantes'];

  
        $Halumno = Vista_HorarioExtrescolar::where('idEstudiantes', $variableidE)->paginate(5);

      //  $this->horarios = HorarioExtraescolares::Where('numeroSemestre', $semes[0]['Semestres_id'])->get();
        $this->dias = Dias::all();
        $this->extraescolares = Extraescolares::all();

        $this->vista = DB::select('CALL view_horario_Extrescolares('.$variableidE.')');
        

    return view('livewire.alumnos.horario.horario', compact('Halumno'));
    }
    public function order($sort){

        if ($this->sort == $sort) {
            
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }

        } else {
            $this->sort = $sort;
        }

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

    public function limpiar(){
        $this->idHorarios = ' ';

    }

    public function editar($id){
        $this->abrirModal();
        $idusuario = auth()->id();
        $idEstudiante = Estudiantes::select('idEstudiantes')->where('id_user',$idusuario)->get();
        $variableidE= $idEstudiante[0]['idEstudiantes'];

        $HA = HorarioExtraescolares::findOrFail($id);
        $this->idHorarioExtraescolar= $id;
        $this->iddia = $HA->iddia;
        $this->HoraInicial = $HA->HoraInicial;
        $this->HoraFinal = $HA->HoraFinal;
        $this->consideraciones = $HA->consideraciones;
        $this->idExtraescolar = $HA->idExtraescolar;
        $this->idEstudiantes = $HA->idEstudiantes;

        $this->abrirModal();
    }
    public function question($id){
       // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.')->showConfirmButton('Confirm', '#3085d6');
       // alert()->success('Post Created', '<strong>Successfully</strong>')->toHtml();

       alert()->html("<button type='submit' wire:click=".$this->delete($id)." class='px-2 py-2 font-bold text-white bg-red-500 hover:bg-red-700'></button>",'success');
     //   HorarioExtraescolares::find($id)->delete();
    
     //toast('Registro eliminado!','success');
        return redirect('/Horario-alumno'); 

    }
    public function delete($id){
       // HorarioExtraescolares::find($id)->delete();
        toast('Registro eliminado!','success');
        return redirect('/Horario-alumno'); 
    }
    Public function guardar(){
        $this->validate();

        $idusuario = auth()->id();
        $idEstudiante = Estudiantes::select('idEstudiantes')->where('id_user',$idusuario)->get();
        $variableidE= $idEstudiante[0]['idEstudiantes'];

        HorarioExtraescolares::updateOrCreate(['idHorarioExtraescolar' => $this->idHorarioExtraescolar],
        [
            'iddia' =>  $this->iddia,
            'HoraInicial' =>  $this->HoraInicial,
            'HoraFinal' =>  $this->HoraFinal,
            'consideraciones' =>  $this->consideraciones,
            'idExtraescolar' =>  $this->idExtraescolar,
            'idEstudiantes' => $variableidE,


    ]);

        $this->idHorarioExtraescolar ? toast('Tú registro fue actualizado correctamente','success') : toast('Registro Guardado con éxito','success');
       // $this->cerrarModal();
        return redirect('/Horario-alumno');
    }

}
