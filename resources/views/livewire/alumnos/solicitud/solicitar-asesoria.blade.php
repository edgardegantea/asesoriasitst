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

            <button wire:click='crear()' class="px-4 py-2 my-3 font-bold text-white bg-green-600 hover:bg-green-600"
                data-toggle="modal" data-target="#exampleModal">
                Nuevo
            </button>

            @if ($modal == true)
            @include('livewire.alumnos.solicitud.crear')
            @endif
            {{ $vistaSA }}

            <table class="table table-condensed table-bordered table-responsive-sm">
                <thead>
                    <tr class="text-white bg-green-600">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Materia Solicitada</th>
                        <th class="px-4 py-2">Justificación</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Acciones</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($vistaSA as $item)

                    <tr>
                        <td class="px-4 py-2 border">{{ $item->idSolicitud }}</td>
                        <td class="px-4 py-2 border">{{ $item->materiaSolicitada }}</td>
                        <td class="px-4 py-2 border">{{ $item->justificacion }}</td>
                        <td class="px-4 py-2 border">

                            @if ($item->estado == "4")
                            <span class="badge bg-warning ">Enviado para su revisión</span>
                            @endif
                            @if ($item->estado == "3")
                            <span class="badge badge-success">Asesoria Autorizada </span>
                            @endif
                            @if ($item->estado == "2")
                            <span class="badge badge-danger">Asesoria Rechazada</span>
                            @endif
                        </td>

                        <td class="px-4 py-2 border">

                            <button wire:click="editar({{ $item->idSolicitud }})"
                                class="px-4 py-2 font-bold text-white bg-blue-500 hover:bg-blue-600" data-toggle="modal"
                                data-target="#exampleModal"><span class="fas fa-edit"></span><button>
                                    <button wire:click="borrar({{$item->idSolicitud }})"
                                        class="px-4 py-2 font-bold text-white bg-red-500 hover:bg-red-700"><span
                                            class="fas fa-trash"></span></button>

                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $vistaSA->links() }}
        </div>
    </div>
</div>