<?php

namespace App\Http\Livewire\Administrador\HorarioMateria;

use Livewire\Component;
use App\Models\Materia;
use App\Models\Modalidades;
use App\Models\Docentes;
use App\Models\Semestres;
use App\Models\vistas\vista_HorarioGeneral;
use App\Models\Horarios;
use App\Models\Dias;
use Livewire\WithPagination;

class HorarioMaterias extends Component
{

    public $search;
    public $sort='id';
    public $direction='asc';

    use WithPagination;
    public $modal = false;

    public  $materia, $iddia, $semestres,$dias, $docentes, $modalidad, $idHorarios, $HoraInicial, $HoraFinal, $idMateria, $idSemestres,$idModalidades, $id_docente;

    protected $rules = [
        'iddia' => 'required',
        'HoraInicial' => 'required',
        'HoraFinal' => 'required',
        'idMateria' => 'required',
        'idModalidades' => 'required',
        'id_docente' => 'required'

    ];
    protected $messages = [
        'iddia.required' => 'El día no puede estar vacío.',
        'HoraInicial.required' => 'Los hora inicial no puede estar vacío.',
        'HoraFinal.required' => 'La hora final de Control no puede estar vacío.',
        'idMateria.required' => 'Seleccione una materia',
        'idModalidades.required' => 'Seleccione una modalidad.',
        'id_docente' => 'Selecciona un docente'


    ];


    public function render()
    {
        $this->dias = Dias::all();
        $horarios= vista_HorarioGeneral::paginate(5);
        $this->materia= Materia::all();
        $this->modalidad= Modalidades::all();
        $this->docentes = Docentes::all();
        $this->semestres = Semestres::all();

        return view('livewire.administrador.horario-materia.horario-materias', compact('horarios'));
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
        $this->iddia = ' ';
        $this->HoraInicial = ' ';
        $this->HoraFinal= ' ';
        $this->idMateria = ' ';
        $this->idModalidades= ' ';
        $this->id_docente=' ';
        $this->idSemestres=' ';
    }

    
    public function editar($id){
        $this->abrirModal();
        $hora = Horarios::findOrFail($id);
        $this->idHorarios= $id;
        $this->iddia = $hora->iddia;
        $this->HoraInicial = $hora->HoraInicial;
        $this->idMateria = $hora->idMateria;
        $this->idModalidades = $hora->idModalidades;
        $this->id_docente = $hora->id_docente;
       $this->idSemestres = $hora->idSemestres;
        $this->abrirModal();
    }

    public function borrar($id){
        Horarios::find($id)->delete();
        session()->flash('message', 'Registro eliminado correctamente.');

    }

    
    Public function guardar(){
        $this->validate();

        Horarios::updateOrCreate(['idHorarios' => $this->idHorarios],
        [
            'iddia' => $this->iddia,
            'HoraInicial' => $this->HoraInicial,
            'HoraFinal' =>$this->HoraFinal,
            'idMateria' => $this->idMateria,
            'idModalidades' =>$this->idModalidades,
            'id_docente' => $this->id_docente,
            'idSemestres' => $this->idSemestres
         
    ]);
    session()->flash('message',
    $this->idHorarios ? '¡Actualización exitosa!' : '¡Alta Exitosa!');

    $this->cerrarModal();
    }
}
