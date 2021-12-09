<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de materias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <label for="nombre" class="block mb-2 text-sm font-bold text-gray-700 ">Nombre del
                                Alumno</label>
                            <input type="text"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="nombre" wire:model="nombre">
                                @error('nombre') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                        </div>

                        <div class="mb-4">
                            <label for="apellidos" class="block mb-2 text-sm font-bold text-gray-700 ">Apellidos</label>
                            <input type="text"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="apellidos" wire:model="apellidos">
                                @error('apellidos') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                        </div>
                        <div class="mb-4">
                            <label for="numeroControl" class="block mb-2 text-sm font-bold text-gray-700 ">Número
                                Control</label>
                            <input type="text"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="numeroControl" wire:model="numeroControl">
                                @error('nombre') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                        </div>
                        <div class="mb-4">
                            <label for="grupo" class="block mb-2 text-sm font-bold text-gray-700 ">Grupo</label>
                            <input type="text"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="grupo" wire:model="grupo">
                                @error('grupo') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                        </div>


                        <div class="mb-4">
                            <label for="Carreras_idCarreras"
                                class="block mb-2 text-sm font-bold text-gray-700 ">Carrera</label>

                            <select id="Carreras_idCarreras" wire:model="Carreras_idCarreras"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                name="select">
                                <option value=" ">Selecciona una carrera... </option>

                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->idCarreras }}">{{ $carrera->nombreCarrera }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Carreras_idCarreras') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                        </div>

                        <div class="mb-4">
                            <label for="Semestres_idSemestres"
                                class="block mb-2 text-sm font-bold text-gray-700 ">Semestre</label>
                            <select id="Semestres_idSemestres" wire:model="Semestres_idSemestres"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                name="Semestres_idSemestres">
                                <option value=" ">Selecciona un semestre... </option>

                                @foreach ($semestres as $semestre)
                                    <option value="{{ $semestre->idSemestres }}">{{ $semestre->numeroSemestre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Semestres_idSemestres') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                        </div>


                        <div class="mb-4">
                            <label for="Modalidades_idModalidades"
                                class="block mb-2 text-sm font-bold text-gray-700 ">Modalidad</label>
                            <select id="Modalidades_idModalidades" wire:model="Modalidades_idModalidades"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                name="Modalidades_idModalidades">
                                <option value=" ">Selecciona una Modalidad... </option>

                                @foreach ($modalidades as $modalidad)
                                    <option value="{{ $modalidad->idModalidades }}">
                                        {{ $modalidad->nombreModalidad }}</option>
                                @endforeach
                            </select>
                            @error('Modalidades_idModalidades') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                        </div>

                        <div class="mb-4">
                            <label for="pass" class="block mb-2 text-sm font-bold text-gray-700 ">Contraseña</label>
                            <input type="password"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="pass" wire:model="pass">
                                @error('pass') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                        </div>

                        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">

                            <span class="flex w-full shadow-sm rounde-md sm:ml-3 sm:w-auto">
                                <button wire:click.prevent="guardar()"  type="button"
                                    class="inline-flex justify-center w-full px-4 py-2 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5 ">Guardar</button>
                            </span>

                            <span class="flex w-full shadow-sm rounde-md sm:ml-3 sm:w-auto">
                                <button wire:click.prevent="cerrarModal()"  data-dismiss="modal" type="button"
                                    class="inline-flex justify-center w-full px-4 py-2 text-white transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5 ">Cancelar</button>
                            </span>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
