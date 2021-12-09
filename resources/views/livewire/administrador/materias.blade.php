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
            @include('livewire.administrador.crear')
            @endif

            <table class="table table-condensed table-bordered table-responsive-sm">
                <thead>
                    <tr class="text-white bg-green-600">
                        <th wire:click="order('id')" class="px-4 py-2 uppercase cursor-pointer">
                            ID

                            @if ($sort == 'id')

                            @if ($direction == 'asc')
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                            @endif
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @endif

                        </th>
                        <th wire:click="order('materia')" class="px-4 py-2 uppercase cursor-pointer">
                            Materia

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

                        <th wire:click="order('carrera')" class="px-4 py-2 cursor-pointer">
                            Carrera
                            @if ($sort == 'carrera')

                            @if ($direction == 'asc')
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up-alt"></i>
                            @endif
                            @else
                            <i class="float-right mt-1 fas fa-sort-alpha-up"></i>
                            @endif

                        </th>
                        <th class="px-4 py-2">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($vistaM as $materia)
                    <tr>
                        <td class="px-2 py-2 border">{{ $materia->id }}</td>
                        <td class="px-2 py-2 border">{{ $materia->materia }}</td>
                        <td class="px-2 py-2 border">{{ $materia->carrera }}</td>

                        <td class="px-2 py-2 border">

                            <button wire:click="editar({{ $materia->id }})"
                                class="px-2 py-2 font-bold text-white bg-blue-500 hover:bg-blue-600" data-toggle="modal"
                                data-target="#exampleModal"><span class="fas fa-edit"></span><button>
                                    <button wire:click="borrar({{ $materia->id }})"
                                        class="px-2 py-2 font-bold text-white bg-red-500 hover:bg-red-700"><span
                                            class="fas fa-trash"></span></button>

                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $vistaM->links() }}
        </div>
    </div>
    @push('js')
    <script src="{{ asset('sweetalert2/package/dist/sweetalert2.all.js') }} "></script>
    <script>
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })

    </script>
    @endpush
</div>