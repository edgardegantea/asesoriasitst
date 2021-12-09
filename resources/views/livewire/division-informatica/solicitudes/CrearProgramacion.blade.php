<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog " style="max-width: 90%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agendar Asesoría</h5>
                <a type="submit" class="close" href=" {{ url('/programacion-Asesoria') }}"><span
                        aria-hidden="true close-btn">×</span></a>
                {{--     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>--}}
            </div>
            <div class="modal-body">

                <div class="mb-4">
                    <label for="nombre" class="block mb-2 text-sm font-bold text-gray-700">Estudiante</label>
                    <input type="text"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="nombre" wire:model="nombre" readonly>
                </div>


                <div class="py-12">
                    <div class="mx-auto max-w-7x1 sm:px6 lg:px-8">
                        <p align="center"> Horario de Extraescolar</p>

                        <table class="table table-condensed table-bordered table-responsive-sm">
                            <thead>

                                <tr class="text-white bg-green-600">
                                    <th class="px-4 py-2 uppercase cursor-pointer">
                                        Matería
                                    </th>

                                    <th class="px-4 py-2 ">

                                        Lunes

                                    </th>


                                    <th class="px-4 py-2 ">

                                        Martes

                                    </th>


                                    <th class="px-4 py-2 ">

                                        Miercoles

                                    </th>
                                    <th class="px-4 py-2">

                                        Jueves

                                    </th>
                                    <th class="px-4 py-2 ">

                                        viernes

                                    </th>

                                    <th class="px-4 py-2">
                                        sábado
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($vista as $hor)
                                <tr>

                                    <td>{{$hor->extraescolar}}</td>

                                    <td>{{$hor->Lunes}}</td>
                                    <td>{{$hor->Martes}}</td>
                                    <td>{{$hor->Miercoles}}</td>
                                    <td>{{$hor->Jueves}}</td>
                                    <td>{{$hor->Viernes}}</td>
                                    <td>{{$hor->Sabado}}</td>

                                </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>
                </div>
                


                <form action="{{route('CrearProgramacion.store')}}" method="post">
                    @csrf

                    <div class="mb-4">
                        <label for="idDocentes" class="block mb-2 text-sm font-bold text-gray-700">Docente</label>
                        <select id="idDocentes" wire:model="selectDocente"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="idDocentes">
                            <option value="NULL" selected>Selecciona una Docente... </option>

                            @foreach ($docentes as $do)
                            <option value="{{ $do->idDocentes }}">{{ $do->nombre }} {{ $do->apellidos }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-4">

                                <label for="fechaAsesoria" class="block mb-2 text-sm font-bold text-gray-700">Fecha
                                    de Inicio</label>
                                <input type="date"
                                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="fechaAsesoria" name="fechaAsesoria">
                                @error('fechaAsesoria') <span style="color:red;" class="error">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-4">


                                <label for="semanas" class="block mb-2 text-sm font-bold text-gray-700">Semenas</label>
                                <input type="int"
                                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="semanas" name="semanas">
                                @error('semanas') <span style="color:red;" class="error">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-4">

                                <label for="HoraInicial"
                                    class="block mb-2 text-sm font-bold text-gray-700 ">HoraInicial</label>

                                <select id="HoraInicial"
                                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    name="HoraInicial">
                                    <option value=" ">Selecciona una hora... </option>

                                    @for ($i=7; $i <=20; $i++) <option value="{{$i}}:00:00">{{ $i }}</option>
                                        @endfor


                                </select>
                                @error('HoraInicial') <span style="color:red;" class="error">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-4">

                                <label for="HoraFinal" class="block mb-2 text-sm font-bold text-gray-700 ">Hora
                                    Final</label>

                                <select id="HoraFinal"
                                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    name="HoraFinal">
                                    <option value=" ">Selecciona una hora... </option>

                                    @for ($i=7; $i <=20; $i++) <option value="{{$i}}:00:00">{{ $i }}</option>
                                        @endfor


                                </select>
                                @error('HoraFinal') <span style="color:red;" class="error">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </div>

                    <input type="hidden"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="idRevicion" wire:model="idRevicion" value="idRevicion" name="idRevicion" readonly>
                    <input type="hidden"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="idEstudiantes" wire:model="idEstudiantes" name="idEstudiantes" value="idEstudiantes"
                        readonly>

                   <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button class="btn btn-success">Guardar</button>
                    <button wire:click.prevent="cerrarModal()" data-dismiss="modal" type="button"
                        class="btn btn-danger">Cancelar</button>
                   </div>
                </form>
                


            </div>
        </div>
    </div>
</div>