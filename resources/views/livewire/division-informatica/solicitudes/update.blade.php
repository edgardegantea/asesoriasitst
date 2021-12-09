<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Autorización de asesoría</h5>
                <button type="button" wire:click.prevent="cerrarModal()" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                        <label for="estado" class="block mb-2 text-sm font-bold text-gray-700 ">Autorización</label>
                        <select id="estado" wire:model="estado"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="estado">
                            <option value="null">Selecciona una opción... </option>
                            <option value="1">Autorizada</option>
                            <option value="2">Rechazada</option>
                            <option value="4">En revisión</option>

                        </select>
                    </div>

                </form>
            </div>

            <div class="px-4 py-3 modal-footer bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">

                <span class="flex w-full shadow-sm rounde-md sm:ml-3 sm:w-auto">
                    <button wire:click.prevent="actualizar()" type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5 ">Guardar</button>
                </span>

                <span class="flex w-full shadow-sm rounde-md sm:ml-3 sm:w-auto">
                    <button wire:click.prevent="cerrarModal()" type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-white transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5 ">Cancelar</button>
                </span>
            </div>

        </div>
    </div>
</div>