<?php

namespace App\Http\Livewire\Administrador\RegistrarAlumno;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Semestres;
use App\Models\Carreras;
use App\Models\Estudiantes;
use App\Models\Modalidades;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\vistas\vistaalumnos;

use App\Models\User;

class Alumno extends Component
{
    use WithPagination;

    public  $carreras, $semestres,$idEstudiantes, $id_user ,$modalidades, $name, $nombre, $numeroControl,$pass ,$apellidos,$grupo,$Carreras_idCarreras,$Semestres_idSemestres,$Modalidades_idModalidades;
    public $modal = false;


    protected $rules = [
        'nombre' => 'required',
        'apellidos' => 'required',
        'numeroControl' => 'required',
        'grupo' => 'required',
        'Carreras_idCarreras' => 'required',
        'Semestres_idSemestres' => 'required',
        'Modalidades_idModalidades' => 'required',
        'pass' => 'required',

    ];
    protected $messages = [
        'nombre.required' => 'El nombre no puede estar vacío.',
        'apellidos.required' => 'Los apellidos no puede estar vacío.',
        'numeroControl.required' => 'El Numero de Control no puede estar vacío.',
        'grupo.required' => 'El grupo no puede estar vacío.',
        'Carreras_idCarreras.required' => 'Seleccione una carrera.',
        'Semestres_idSemestres.required' => 'Seleccione un Semestre..',
        'Modalidades_idModalidades.required' => 'Seleccione una modalidad.',
        'pass.required' => 'Contraseña invalida.',

    ];


    public function render()
    {
        $vistaAlumnos = vistaalumnos::paginate(5);

        $this->semestres= Semestres::all();
        $this->carreras= Carreras::all();
        $this->modalidades= Modalidades::all();

        return view('livewire.administrador.registrar-alumno.alumno',compact('vistaAlumnos'));
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
        $this->nombre = ' ';
        $this->apellidos = ' ';
        $this->numeroControl= ' ';
        $this->grupo= ' ';
        $this->Carreras_idCarreras= ' ';
        $this->Semestres_idSemestres= ' ';
        $this->Modalidades_idModalidades= ' ';
        $this->pass= '';


    }

    public function editar($id){
       // echo('<input type=text>');
        $usuario = User::findOrFail($id);
      //  echo $usuario;
        $estudiante = Estudiantes::Where('Users_id',$id)->get();

        $this->id_user= $id;
        $this->idEstudiantes= $estudiante[0]['idEstudiantes'];

        $this->name = $usuario->name;
        $this->numeroControl = $usuario->email;
        $this->pass = $usuario->password;

        $this->nombre =$estudiante[0]['nombre'];
        $this->apellidos = $estudiante[0]['apellido'];
        $this->grupo = $estudiante[0]['grupo'];

        $this->Carreras_idCarreras = $estudiante[0]['Carreras_idCarreras'];
        $this->Semestres_idSemestres = $estudiante[0]['Semestres_idSemestres'];
        $this->Modalidades_idModalidades = $estudiante[0]['Semestres_idSemestres'];


        $this->abrirModal();
    }

    public function borrar($id){
       // User::find($id)->delete();
       // $estudiante = Estudiantes::Where('Users_id',$id)->get();
    }

    Public function guardar(){
        $this->validate();

        if($this->id_user != null){
           User::where('id_user', $this->id_user)
           ->update([                
            'id_user' => $this->id_user,
            'name' => $this->nombre,
            'email' => $this->numeroControl,
            'password' => $this->pass,
            ]);
            
            $estudiante = Estudiantes::Where('Users_id',$this->id_user)->get();

            Estudiantes::where('idEstudiantes',$estudiante[0]['idEstudiantes'])
            ->update([
                'idEstudiantes' => $this->idEstudiantes,
                'nombre' => $this->nombre,
                'apellido' => $this->apellidos,
                'grupo' => $this->grupo,
    
                'Carreras_idCarreras' => $this->Carreras_idCarreras,
                'Semestres_idSemestres' =>$this->Semestres_idSemestres,
                'Modalidades_idModalidades' => $this->Modalidades_idModalidades,
                'Users_id' =>  $this->id_user
             ]);
        }

        else {
            $user = ([
                'name' => $this->nombre,
                'email' => $this->numeroControl,
                'password' => Hash::make($this->pass),
            ]);
             User::create($user);


             $lastid = DB::table('users')->latest()->first();
      
            $estudiante = ([
            'nombre' => $this->nombre,
            'apellido' => $this->apellidos,
            'grupo' => $this->grupo,

            'Carreras_idCarreras' => $this->Carreras_idCarreras,
            'Semestres_idSemestres' =>$this->Semestres_idSemestres,
            'Modalidades_idModalidades' => $this->Modalidades_idModalidades,
            'Users_id' =>  $lastid->id_user
        ]);

        Estudiantes::create($estudiante);

        }

        $this->cerrarModal();
    }
}
