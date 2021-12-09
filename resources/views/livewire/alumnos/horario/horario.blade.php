<div class="py-12">
    <div class="mx-auto max-w-7x1 sm:px6 lg:px-8">
        <div class="px-4 py-4 overflow-auto bg-white shadow-xl sm:rounded-lg">

            @if (session()->has('message'))
            <div class="px-4 py-4 my-3 text-teal-900 bg-teal-100 rounded shadow-md -b" role="alert">
                <div class="flex">
                    <div>
                        <h4> {{ session('message') }}</h4>
                    </div>
                </div>
            </div>
            @endif


            <div class="form-row">
                <div class="col">
                    <button wire:click='crear()' class="btn btn-success" data-toggle="modal"
                        data-target="#exampleModal">Nuevo</button>
                </div>
                <div class="col">
                    <x-jet-input class="w-full" placeholder="¿Qué estas buscando?" type="text" wire:model="search" />

                </div>
            </div>
            <br>


            @if ($modal)
            @include('livewire.alumnos.horario.crear')
            @endif

            <table class="table table-condensed table-bordered table-responsive-sm">
                <thead>
                    <tr class="text-white bg-green-600">
                        <th wire:click="order('idHorariosAlumnos')" class="px-4 py-2 uppercase cursor-pointer">
                            ID

                            @if ($sort == 'idHorariosAlumnos')

                            @if ($direction == 'asc')
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                            @endif
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @endif

                        </th>

                        <th wire:click="order('materia')" class="px-4 py-2 cursor-pointer">

                            materia
                            @if ($sort == 'materia')

                            @if ($direction == 'asc')
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                            @endif
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @endif
                        </th>
                        <th wire:click="order('dia')" class="px-4 py-2 cursor-pointer">
                            dia
                            @if ($sort == 'dia')

                            @if ($direction == 'asc')
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                            @endif
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @endif

                        </th>
                        <th wire:click="order('hora')" class="px-4 py-2 cursor-pointer">
                            hora
                            @if ($sort == 'hora')

                            @if ($direction == 'asc')
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                            @endif
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @endif

                        </th>

    
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Halumno as $hor)
                    <tr>
                        <td class="px-2 py-2 border">{{ $hor->idHorarioExtraescolar }}</td>
                        <td class="px-2 py-2 border">{{ $hor->nombreExtraescolar }}</td>

                        <td class="px-2 py-2 border">{{ $hor->descripcion }}</td>
                        <td class="px-2 py-2 border">{{ $hor->horario }}</td>


                        <td class="px-2 py-2 border">

                            <button wire:click="editar({{ $hor->idHorarioExtraescolar }})"
                                class="px-2 py-2 font-bold text-white bg-blue-500 hover:bg-blue-600" data-toggle="modal"
                                data-target="#exampleModal"><span class="fas fa-edit"></span><button>
                                    <button wire:click="question({{ $hor->idHorarioExtraescolar }})"
                                        class="px-2 py-2 font-bold text-white bg-red-500 hover:bg-red-700"><span
                                            class="fas fa-trash"></span></button>

                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $Halumno->links() }}
        </div>
    </div>

</div>

@include('sweetalert::alert')

<div class="py-12">
    <div class="mx-auto max-w-7x1 sm:px6 lg:px-8">
        <p align="center">Vista previa</p>

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
@include('sweetalert::alert')

</div>