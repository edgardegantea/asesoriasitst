<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Administrador\Materias;
use App\Http\Livewire\Administrador\HorarioMateria\HorarioMaterias;
use App\Http\Livewire\Administrador\RegistrarAlumno\Alumno;
use App\Http\Livewire\Administrador\RegistrarMaestro\Docente;
use App\Http\Livewire\DivisionInformatica\Solicitudes\RevisionSolicitudes as revision;
use App\Http\Livewire\Alumnos\Solicitud\SolicitarAsesoria;
use App\Http\Livewire\Alumnos\Horario\Horario;
use App\Http\Livewire\Docentes\Horarios\Horario as horarioDocentes;
use App\Http\Livewire\DivisionInformatica\Solicitudes\ProgramacionAsesorias;
use App\Http\Controllers\AsesoriaController;
use App\Http\Controllers\AsesoriaDocenteController;
use App\Http\Controllers\AsesoriaAlumnoController;
use App\Http\Controllers\AsesoriaDivisionController;

use App\Http\Controllers\NotificationsController;

use App\Http\Livewire\Docentes\Asesorias\Asesorias;
use App\Http\Livewire\Alumnos\Asesorias\Asesorias as asesorias_alumnos;

/*AsesoriaAlumnoController
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    //Route de Administración
    Route::get('/Materia',Materias::class)->middleware('can:materias')->name('materias');
    Route::get('/Alumno',Alumno::class)->middleware('can:RegistroAlumnos')->name('RegistroAlumnos');
    Route::get('/Docente',Docente::class)->middleware('can:RegistroDocente')->name('RegistroDocente');
    Route::get('/Horario-materia',HorarioMaterias::class)->middleware('can:HorarioMaterias')->name('HorarioMaterias');


    Route::get('notifications/get', [NotificationsController::class, 'getNotificationsData'])->name('notifications.get');

   Route::get('notifications/getvinculacion', [NotificationsController::class, 'getNotificationsDataVINCULACION'])->name('notifications.get');

    //Route de Alumno
    Route::get('/Solicitar-Asesoria',SolicitarAsesoria::class)->middleware('can:SolicitarAsesoria')->name('SolicitarAsesoria');
    Route::get('/Horario-alumno',Horario::class)->middleware('can:HorarioAlumno')->name('HorarioAlumno');
    Route::get('/Asesorias-alumno', asesorias_alumnos::class)->name('AsesoriasAlumnos')->middleware('can:AsesoriasAlumnos');
    Route::resource('/Alumnos-Asesoria', AsesoriaAlumnoController::class)->names('AlumnosAsesorias')->middleware('can:AlumnosAsesorias'); 


    //Route de Division
    Route::get('/Revision-Asesoria',revision::class)->middleware('can:RevisionAsesoria')->name('RevisionAsesoria');
    Route::get('/programacion-Asesoria',ProgramacionAsesorias::class)->middleware('can:ProgramacionAsesoria')->name('ProgramacionAsesoria');
    Route::resource('/programacion-Asesoria/store', AsesoriaController::class)->middleware('can:CrearProgramacion')->names('CrearProgramacion')->only('store'); 
    Route::resource('/Validaciones-Asesorias', AsesoriaDivisionController::class)->names('validacionAsesoria'); 

    //Route de Docente
    //Route::get('/Docente/Horarios', horarioDocentes::class)->middleware('can:HorarioDocente')->name('HorarioDocente');
    Route::get('/Asesorias',Asesorias::class)->middleware('can:AsesoriasDocente')->name('AsesoriasDocente');
    Route::resource('/Docentes-Asesoria', AsesoriaDocenteController::class)->names('Docentes-Asesoria'); 

    Route::get('/dashboard',function () {
        return view('dashboard');
    })->name('dashboard');
});
