<div>
    <!-- GRUPO BOTONES INICIO -->
    <div class="flex justify-between items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 ">Compras</h2>
        <div class="flex ">
            <a href="{{ route('compras.crearfactura', ['tipo' => 'Compra']) }}"
                class="mr-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Compra +
            </a>
            <a href="{{ route('compras.crearticket')}}"
                class="mr-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Ticket +
            </a>
        </div>
    </div>
    <!-- MODAL ELIMINAR -->
    <div>
        @if($modalEliminar)
        <!-- Overlay -->
        <div class="fixed inset-0 z-40 bg-black opacity-50"></div>

        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <!-- Superposición del modal (fondo oscuro) -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>

            <!-- Contenido del Modal -->
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xl sm:mx-4 sm:rounded-xl mx-auto z-50 relative">
                <!-- Título -->
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Eliminar Compra</h3>

                <!-- Descripción -->
                <p class="text-sm text-gray-700  mb-4">
                    ¿Está seguro de que desea eliminar esta compra?
                </p>

                <!-- Botones -->
                <div class="mt-6 flex justify-end space-x-4">
                    <!-- Botón Cancelar -->
                    <button
                        type="button"
                        wire:click="cerrarModalEliminar"
                        class="px-4 py-2 text-sm bg-gray-300 text-gray-800 font-medium rounded hover:bg-gray-400 focus:outline-none focus:shadow-outline">
                        Cancelar
                    </button>

                    <!-- Botón Eliminar -->
                    <button
                        type="button"
                        wire:click="eliminarComprobante"
                        class="ml-2 px-4 py-2 text-sm bg-red-600 text-white font-medium rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- TABLA -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b  bg-gray-50 ">
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Documento</th>
                        <th class="px-4 py-3">Tipo</th>
                        <th class="px-4 py-3">Proveedor</th>
                        <th class="px-4 py-3">Descripción</th>
                        <th class="px-4 py-3">Subtotal</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody
                    class="bg-white divide-y ">@foreach($compras as $compra)
                    <tr class="text-gray-700 ">
                        <td class="px-4 py-3 text-sm">
                            {{$compra->fecha->format('d-m-Y')}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$compra->numero}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$compra->tipo}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$compra->proveedor}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$compra->descripcion}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$compra->subtotal}} €
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$compra->total}} €
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <!--BOTON EDITAR -->
                                <button
                                    wire:click="editarComprobante({{$compra->id}},'{{$compra->tipo}}')"
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit">
                                    <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </button>
                                <!--BOTON ELIMINAR -->
                                <button
                                    wire:click="abrirModalEliminar({{$compra->id}},'{{$compra->tipo}}')"
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Delete">
                                    <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>