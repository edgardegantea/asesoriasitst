<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Docentes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <label for="nombre" class="block mb-2 text-sm font-bold text-gray-700 ">Nombre del
                                Docente</label>
                            <input type="text"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="nombre" wire:model="nombre">
                        </div>

                        <div class="mb-4">
                            <label for="apellidos" class="block mb-2 text-sm font-bold text-gray-700 ">Apellidos</label>
                            <input type="text"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="apellidos" wire:model="apellidos">
                        </div>
                        <div class="mb-4">
                            <label for="numeroControl" class="block mb-2 text-sm font-bold text-gray-700 ">Número
                                Control</label>
                            <input type="text"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="numeroControl" wire:model="numeroControl">
                        </div>


                        <div class="mb-4">
                            <label for="pass" class="block mb-2 text-sm font-bold text-gray-700 ">Contraseña</label>
                            <input type="password"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="pass" wire:model="pass">
                        </div>

                        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">

                            <span class="flex w-full shadow-sm rounde-md sm:ml-3 sm:w-auto">
                                <button wire:click.prevent="guardar()" type="button"
                                    class="inline-flex justify-center w-full px-4 py-2 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5 ">Guardar</button>
                            </span>

                            <span class="flex w-full shadow-sm rounde-md sm:ml-3 sm:w-auto">
                                <button wire:click.prevent="cerrarModal()" type="button"
                                    class="inline-flex justify-center w-full px-4 py-2 text-white transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5 ">Cancelar</button>
                            </span>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
