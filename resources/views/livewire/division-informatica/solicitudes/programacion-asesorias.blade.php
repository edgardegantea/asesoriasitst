<div class="py-12">
<ul class="mb-3 nav nav-pills" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-Autorizada-tab" data-toggle="pill" href="#pills-Autorizada" role="tab"
            aria-controls="pills-Autorizada" aria-selected="true">Asesorías Pendientes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-Programadas-tab" data-toggle="pill" href="#pills-Programadas" role="tab"
            aria-controls="pills-Programadas" aria-selected="false">Asesorias Programadas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-Canceladas-tab" data-toggle="pill" href="#pills-Canceladas" role="tab"
            aria-controls="pills-contact" aria-selected="false">Asesorías Canceladas</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-Autorizada" role="tabpanel" aria-labelledby="pills-Autorizada-tab">



  
            <div class="mx-auto max-w-7x1 sm:px6 lg:px-8">
                <div class="px-4 py-4 overflow-auto bg-white shadow-xl sm:rounded-lg">
                    <h2 align='center'>Asesorías Autorizadas</h2>

                    @if (session()->has('message'))
                    <div class="px-4 py-4 my-3 text-teal-900 bg-teal-100 rounded shadow-md -b" role="alert">
                        <div class="flex">
                            <div>
                                <h4> {{ session('message') }}</h4>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($modal == true)
                    @include('livewire.division-informatica.solicitudes.CrearProgramacion')
                    @endif



                    <div class="row">
                        @foreach ($vistaRE as $item)

                        @if($item->estado == '1')

                        <div class="col-sm-4">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title"><STRONG>Estado:</STRONG> <span
                                            class="badge badge-success">Autorizada</span></h3>
                                </div>
                                <div class="card-body">

                                    <STRONG> Estudiante: </STRONG>{{ $item->estudiante }}
                                    <br>
                                    <STRONG>Materia Solicitada:</STRONG> {{ $item->materiaSolicitada }}
                                    <br>
                                    <STRONG>Justificación:</STRONG> {{ $item->justificacion }}
                                    <br>
                                    <STRONG>Fecha:</STRONG> {{ $item->updated_at }}
                                    <br>

                                </div>
                                <div class="card-footer">


                                    <button wire:click="editar({{ $item->idSolicitud }})" type="button"
                                        class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <span class="fas fa-list-alt">
                                            Programar Asesoría
                                        </span>
                                    </button>


                                    <button wire:click="Visualizar({{ $item->idSolicitud }})")" type="button" class="btn btn-success"
                                        data-toggle="modal" data-target="#exampleModal">
                                        <span class="fas fa-eye">
                                        </span>
                                    </button>

                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>


    </div>
    <div class="tab-pane fade" id="pills-Programadas" role="tabpanel" aria-labelledby="pills-Programadas-tab">


        <div class="py-12">
            <div class="mx-auto max-w-7x1 sm:px6 lg:px-8">
                <div class="px-4 py-4 overflow-auto bg-white shadow-xl sm:rounded-lg">
                    <h2 align='center'>Asesorías Programadas</h2>

                    <div class="row">
                        @foreach ($vistaRE as $item)
                        @if($item->estado == '3')

                        <div class="col-sm-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><STRONG>Estado:</STRONG> <span
                                            class="badge badge-primary">Asesoría
                                            Programada</span></h3>
                                </div>
                                <div class="card-body">

                                    <STRONG> Estudiante: </STRONG>{{ $item->estudiante }}
                                    <br>
                                    <STRONG>Materia Solicitada:</STRONG> {{ $item->materiaSolicitada }}
                                    <br>
                                    <STRONG>Justificación:</STRONG> {{ $item->justificacion }}
                                    <STRONG>Fecha:</STRONG> {{ $item->updated_at }}

                                    <br>

                                </div>
                                <div class="card-footer">



                                    <a class="btn btn-primary" href="{{ url('/Validaciones-Asesorias',['item'=>$item->idSolicitud.'/edit']) }}">
                                        <span class="fas fa-eye">
                                        </span>
    
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>


    </div>
    <div class="tab-pane fade" id="pills-Canceladas" role="tabpanel" aria-labelledby="pills-Canceladas-tab">...</div>
</div>
</div>
