<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de solicitudes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="justificacion">Justificación de Asesoría</label>
                        <textarea type="textarea" class="form-control" id="justificacion" placeholder="justificacion"
                            wire:model="justificacion"></textarea>
                        @error('justificacion') <span style="color:red;" class="error">{{ $message }}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="idMateria" class="block mb-2 text-sm font-bold text-gray-700 ">Materia</label>
                        <select id="idMateria" wire:model="idMateria"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="idMateria">
                            <option value=" " selected>Selecciona una materia... </option>

                            @foreach ($materia as $ma)
                            <option value="{{ $ma->idMateria }}">{{ $ma->nombreMateria }}</option>
                            @endforeach
                        </select>
                        @error('idMateria') <span style="color:red;" class="error">{{ $message }}</span> @enderror

                    </div>

                </form>
            </div>

            <div class="px-4 py-3 modal-footer bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">

                <span class="flex w-full shadow-sm rounde-md sm:ml-3 sm:w-auto">
                    <button wire:click.prevent="guardar()" type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5 ">Guardar</button>
                </span>

                <span class="flex w-full shadow-sm rounde-md sm:ml-3 sm:w-auto">
                    <button wire:click.prevent="cerrarModal()" data-dismiss="modal" type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-white transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5 ">Cancelar</button>
                </span>
            </div>

        </div>
    </div>
</div>