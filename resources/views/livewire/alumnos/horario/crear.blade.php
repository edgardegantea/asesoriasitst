<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Horario Extraescolar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form>




                    <div class="mb-4">
                        <label for="idExtraescolar" class="block mb-2 text-sm font-bold text-gray-700 ">Extraescolar</label>
                        <select id="idExtraescolar" wire:model="idExtraescolar"
                            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            name="idExtraescolar ">
                            <option value=" ">Selecciona una Extraescolar... </option>

                            @foreach ($extraescolares as $Extra)
                            <option value="{{ $Extra->idExtraescolar }}"> {{$Extra->nombreExtraescolar}} </option>
                            @endforeach
                        </select>
                        @error('idExtraescolar') <span style="color:red;" class="error">{{ $message }}</span>
                        @enderror

                    </div>


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
                        <label for="HoraInicial" class="block mb-2 text-sm font-bold text-gray-700 ">Hora Inicial</label>

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
                        <label for="HoraFinal" class="block mb-2 text-sm font-bold text-gray-700 ">Hora Final</label>

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
                        <label for="consideraciones" class="block mb-2 text-sm font-bold text-gray-700 ">Observaciones</label>

                        <Textarea type="text"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="consideraciones" wire:model="consideraciones"></Textarea>
                        @error('consideraciones') <span style="color:red;" class="error">{{ $message }}</span> @enderror

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