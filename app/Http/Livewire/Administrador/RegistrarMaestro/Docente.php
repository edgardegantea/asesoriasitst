<?php

namespace App\Http\Livewire\Administrador\RegistrarMaestro;

use Livewire\WithPagination;

use Livewire\Component;
use App\Models\User;
use App\Models\Docentes;
use App\Models\vistas\vistadocentes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Docente extends Component
{
    public $idDocentes, $id_user, $users_id_user, $name, $nombre, $numeroControl,$pass ,$apellidos;
    use WithPagination;
    public $modal = false;

    public function render()
    {

         $vistaDocentes = vistadocentes::paginate(5);

        return view('livewire.administrador.registrar-maestro.docentes', compact('vistaDocentes'));
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
        $this->nombreMateria = ' ';
        $this->Carreras_idCarreras = ' ';
        $this->Semestres_idSemestres= ' ';
    }


    public function editar($id){
        // echo('<input type=text>');
         $usuario = User::findOrFail($id);
       //  echo $usuario;
         $docente = Docentes::Where('users_id_user',$id)->get();
 
         $this->id_user= $id;
         $this->idDocentes= $docente[0]['idDocentes'];
 
         $this->name = $usuario->name;
         $this->numeroControl = $usuario->email;
         $this->pass = $usuario->password;
 
         $this->nombre =$docente[0]['nombre'];
         $this->apellidos = $docente[0]['apellidos'];
 
 
 
         $this->abrirModal();
     }

    Public function guardar(){
    
        if($this->id_user != null){
           User::where('id_user', $this->id_user)
           ->update([                
            'id_user' => $this->id_user,
            'name' => $this->nombre,
            'email' => $this->numeroControl,
            'password' => $this->pass,
            ]);
            
            $docente = Docentes::Where('users_id_user',$this->id_user)->get();

            Docentes::where('idDocentes',$idDocentes[0]['idDocentes'])
            ->update([
                'idDocentes' => $this->idDocentes,
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos,

                'users_id_user' =>  $this->id_user
             ]);
             $this->cerrarModal();
             $this->limpiar();
        }

        else {
            $user = ([
                'name' => $this->nombre,
                'email' => $this->numeroControl,
                'password' => Hash::make($this->pass),
            ]);
             User::create($user);


             $lastid = DB::table('users')->latest()->first();
      
            $docente = ([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,

            'users_id_user' =>  $lastid->id_user
        ]);

        Docentes::create($docente);
        $this->cerrarModal();
        $this->limpiar();
        }

    }
}
