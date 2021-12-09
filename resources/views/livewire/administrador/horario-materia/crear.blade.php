<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Horario de una materia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form>


                    <div class="mb-4">
                        <label for="iddia" class="block mb-2 text-sm font-bold text-gray-700 ">dia</label>


                        <select id="iddia" wire:model="iddia"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="select">
                            <option value=" ">Selecciona una Dia... </option>

                            @foreach ($dias as $di)
                            <option value="{{ $di->idDia }}">{{ $di->descripcion }}
                            </option>
                            @endforeach
                        </select>
                        @error('iddia') <span style="color:red;" class="error">{{ $message }}</span> @enderror


                    </div>

                    <div class="mb-4">
                        <label for="HoraInicial" class="block mb-2 text-sm font-bold text-gray-700 ">HoraInicial</label>

                        <select id="HoraInicial" wire:model="HoraInicial"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="select">
                            <option value=" ">Selecciona una hora... </option>

                            @for ($i=7; $i <=20; $i++) <option value="{{$i}}:00:00">{{ $i }}</option>
                                @endfor


                        </select>
                        @error('HoraInicial') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                    </div>

                    <div class="mb-4">
                        <label for="HoraFinal" class="block mb-2 text-sm font-bold text-gray-700 ">HoraFinal</label>

                        <select id="HoraFinal" wire:model="HoraFinal"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="select">
                            <option value=" ">Selecciona una hora... </option>

                            @for ($i=7; $i <=20; $i++) <option value="{{$i}}:00:00">{{ $i }}</option>
                                @endfor


                        </select>
                        @error('HoraFinal') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                    </div>



                    <div class="mb-4">
                        <label for="idMateria" class="block mb-2 text-sm font-bold text-gray-700 ">Materia</label>

                        <select id="idMateria" wire:model="idMateria"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="select">
                            <option value="null">Selecciona una Materia... </option>

                            @foreach ($materia as $mater)
                            <option value="{{ $mater->idMateria }}">{{ $mater->nombreMateria }}
                            </option>
                            @endforeach
                        </select>
                        @error('idMateria') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                    </div>

                    <div class="mb-4">
                        <label for="idModalidades" class="block mb-2 text-sm font-bold text-gray-700 ">Modalidad</label>
                        <select id="idModalidades" wire:model="idModalidades"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="idModalidades">
                            <option value="null">Selecciona un Modalidad... </option>

                            @foreach ($modalidad as $modali)
                            <option value="{{ $modali->idModalidades }}">{{ $modali->nombreModalidad }}
                            </option>
                            @endforeach
                        </select>
                        @error('idModalidades') <span style="color:red;" class="error">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="mb-4">
                        <label for="id_docente" class="block mb-2 text-sm font-bold text-gray-700 ">Docente</label>
                        <select id="id_docente" wire:model="id_docente"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="id_docente">
                            <option value="null">Selecciona un Docente... </option>

                            @foreach ($docentes as $docente)
                            <option value="{{ $docente->idDocentes }}">{{ $docente->nombre }}
                                {{ $docente->apellidos }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_docente') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                    </div>
                    <div class="mb-4">
                        <label for="idSemestres" class="block mb-2 text-sm font-bold text-gray-700 ">Semestre</label>
                        <select id="idSemestres" wire:model="idSemestres"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="idSemestres">
                            <option value="null">Selecciona un semestre... </option>

                            @foreach ($semestres as $semestre)
                            <option value="{{ $semestre->idSemestres }}">{{ $semestre->numeroSemestre }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">

                        <span class="flex w-full shadow-sm rounde-md sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="guardar()" data-dismiss="modal" type="button"
                                class="inline-flex justify-center w-full px-4 py-2 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5 ">Guardar</button>
                        </span>

                        <span class="flex w-full shadow-sm rounde-md sm:ml-3 sm:w-auto">
                            <button wire:click.prevent="cerrarModal()" data-dismiss="modal" type="button"
                                class="inline-flex justify-center w-full px-4 py-2 text-white transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5 ">Cancelar</button>
                        </span>
                    </div>

            </div>
            </form>
        </div>
    </div>
</div>