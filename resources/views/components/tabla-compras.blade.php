<div>
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