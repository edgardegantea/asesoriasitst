

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Visualizador</h5>
                <button type="button" wire:click.prevent="cerrarview()" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form>
            
                    <div class="mb-4">
                        <label for="estudiante"
                            class="block mb-2 text-sm font-bold text-gray-700 ">Estudiante</label>
                        <input type="text"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="estudiante" wire:model="estudiante" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="numeroControl"
                            class="block mb-2 text-sm font-bold text-gray-700 ">Número Control</label>
                        <input type="text"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="numeroControl" wire:model="numeroControl" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="materiaSolicitada"
                            class="block mb-2 text-sm font-bold text-gray-700 ">Materia Solicitada</label>
                        <input type="text"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="materiaSolicitada" wire:model="materiaSolicitada" readonly>
                    </div>

                    
                    <div class="mb-4">
                        <label for="justificacion"
                            class="block mb-2 text-sm font-bold text-gray-700 ">Justificacion</label>
                        <textarea type="text"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="justificacion" wire:model="justificacion" readonly></textarea>
                    </div>

                    
                    <div class="mb-4">
                        <label for="estado"
                            class="block mb-2 text-sm font-bold text-gray-700 ">Estado</label>
                        <input type="text"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="estado" wire:model="estado" readonly>
                    </div>

                    <button type="button"  class="btn btn-primary btn-lg btn-block"><span
                        class="fas fa-file-download"  data-toggle="modal" data-target="#exampleModal"></span></button>

    
                </form>
            </div>


        </div>
    </div>
</div>