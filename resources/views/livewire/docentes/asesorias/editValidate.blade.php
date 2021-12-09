@extends('adminlte::page')
@section('content')



<div class="py-12">
    <div class="mx-auto max-w-7x1 sm:px6 lg:px-8">
        <div class="px-4 py-4 overflow-auto bg-white shadow-xl sm:rounded-lg">
            <h2 align='center'>Asesorías</h2>



            <table class="table table-condensed table-bordered table-responsive-sm">
                <thead>
                    <tr class="text-white bg-green-600">
                        <th wire:click="order('id')">
                            ID


                        </th>
                        <th wire:click="order('materia')">
                            Fecha

                        </th>

                        <th wire:click="order('carrera')">
                            Hora


                        </th>

                        <th class="px-4 py-2">validación Docente</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($Asesorias as $asesorias)
                    <tr>
                        <td class="px-2 py-2 border">{{ $asesorias->idAsesorias }}</td>
                        <td class="px-2 py-2 border">{{ $asesorias->fecha }}</td>
                        <td class="px-2 py-2 border">{{ $asesorias->hora }}</td>

                        <td align="center">
                            <form action="{{ route('Docentes-Asesoria.update',$asesorias->idAsesorias) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                @if ($asesorias->ConfimacionDocente == '1' )
                                <input type="checkbox" id="cbox2"  checked readonly> <label for="cbox2"></label>

                               
                                @else

                                <input type="checkbox" id="cbox2" name="ConfimacionDocente" value="1"> <label for="cbox2"></label>

                                <button class="px-2 py-2 font-bold text-white bg-blue-500 hover:bg-blue-600"><span
                                        class="fas fa-edit"></span><button>
                                @endif

                            </form>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>



        </div>
    </div>
</div>



@stop


@section('css')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


@livewireStyles
@stop

@section('js')
<script src="{{ mix('js/app.js') }}" defer></script>
<script src="{{ asset('sweetalert2/package/dist/sweetalert2.all.min.js') }} "></script>
<script src="{{ asset('sweetalert2/package/dist/sweetalert2.all.js') }} "></script>

<!--<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script> JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
{{--<script type="text/javascript">
        window.livewire.on({
            $('#exampleModal').modal('hide');
        });
    </script>--}}
@stop