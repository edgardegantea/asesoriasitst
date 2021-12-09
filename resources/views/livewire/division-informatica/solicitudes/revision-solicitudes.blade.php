

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



                <!--  <button wire:click='crear()'
                    class="px-4 py-2 my-3 font-bold text-white bg-green-600 hover:bg-green-600">Nuevo</button>-->

                @if ($modal == true and $visualizar  == false)
                @include('livewire.division-informatica.solicitudes.update')
                
                @elseif($visualizar == true and $modal == false)
                @include('livewire.division-informatica.solicitudes.view')
                
                @else
                {{$visualizar = false}}
                {{$modal = false}}
                          

                @endif


                <table class="table table-condensed table-bordered table-responsive-sm">
                    <thead>
                        <tr class="text-white bg-green-600">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Estudiante</th>

                            <th class="px-4 py-2">Materia Solicitada</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2">Acciones</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($vistaRE as $item)

                        <tr>


                            <td class="px-2 py-2 border">{{ $item->idSolicitud }}</td>
                            <td class="px-2 py-2 border">{{ $item->estudiante }}</td>
                            <td class="px-2 py-2 border">{{ $item->materiaSolicitada }}</td>
                            <td class="px-2 py-2 border">

                                @if ($item->estado == '4')
                                <span class="badge bg-warning ">En revisión</span>
                                @endif
                                @if ($item->estado == '1')
                                <span class="badge badge-success">Autorizada</span>
                                @endif
                                @if ($item->estado == '2')
                                <span class="badge badge-danger">Rechazada</span>
                                @endif
                            </td>

                            <td class="px-4 py-2 border">

                                <button wire:click="editar({{ $item->idSolicitud }})"
                                    class="px-2 py-2 font-bold text-white bg-blue-500 hover:bg-blue-600"><span
                                        class="fas fa-edit" data-toggle="modal"
                                        data-target="#exampleModal"></span><button>
                                        <button wire:click="view({{ $item->idSolicitud }})"
                                            class="px-2 py-2 font-bold text-white bg-green-500 hover:bg-green-700"
                                            data-toggle="modal" data-target="#exampleModal"><span
                                                class="fas fa-eye"></span></button>

                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $vistaRE->links() }}
            </div>
        </div>
    </div>

</div>