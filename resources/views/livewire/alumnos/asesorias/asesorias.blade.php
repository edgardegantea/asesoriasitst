<div class="py-12">
    <div class="mx-auto max-w-7x1 sm:px6 lg:px-8">
        <div class="px-4 py-4 overflow-auto bg-white shadow-xl sm:rounded-lg">
            <h2 align='center'>Asesorías</h2>
            
            <div class="row">
                @foreach ($vista as $item)
                <div class="col-sm-4">
                   
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title"><STRONG>Estado:</STRONG>
                                 <span
                                    class="badge badge-success">Autorizada</span></h3>
                        </div>
                        <div class="card-body">

                            <STRONG> Estudiante: </STRONG>{{ $item->nombre }}
                            <br>
                            <STRONG>Materia Solicitada:</STRONG> {{ $item->nombreMateria }}
                            <br>
                            <STRONG>Justificación:</STRONG> {{ $item->justificacion }}


                            <br>

                        </div>
                        <div class="card-footer">
                            @if($item->estado != '5')
                            <a class="btn btn-primary form-group" href="{{ url('/Alumnos-Asesoria',['item'=>$item->idSolicitud.'/edit']) }}">
                                <span class="fas fa-list-alt">
                                    Programación
                                </span>
                            </a>    
                                <button wire:click.prevent="cancelarAsesoria({{$item->idSolicitud}})" data-dismiss="modal" type="button"
                                    class="btn btn-danger form-group">Cancelar</button>

                                    @endif

                        </div>
                    </div>
                    
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>