<div>
    <form wire:submit.prevent="guardarTicket">
        <!-- BOTÓN CREAR Y EDITAR -->
        <div class="flex justify-between items-center">
            @if($modoEditar)
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Editar Ticket</h2>
            <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Actualizar
            </button>
            @else
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Nuevo Ticket</h2>
            <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Guardar
            </button>
            @endif
        </div>
        <div class="flex gap-4 items-stretch">
            <!-- Área izquierda (subir documento) -->
            <div class="w-2/5">
                <label for="fileUpload" class="flex flex-col items-center justify-center w-full h-full px-4 transition bg-white border-2 border-dashed rounded-lg cursor-pointer hover:bg-gray-100 border-gray-300 text-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L4 7m3-3l3 3m7 4v8m0 0l3-3m-3 3l-3-3" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">
                        <span class="font-medium">Selecciona</span> o arrastra un documento
                    </p>
                    <input id="fileUpload" type="file" class="hidden" />
                </label>
            </div>
            <!-- Área derecha de inputs, tabla y totales -->
            <div class="w-3/5 bg-white rounded-lg px-6 py-4">
                <!-- Inicio Inputs -->
                <div class="flex gap-6 justify-around items-center">
                    <!-- Proveedor -->
                    <label class="block mt-4 text-sm w-full">
                        <span class="text-gray-700 dark:text-gray-400">
                            Proveedor
                        </span>
                        <select wire:model="proveedor_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value="">Proveedor</option>
                            @foreach($proveedores as $proveedor)
                            <option value="{{$proveedor->id}}">{{$proveedor->persona->nombre}}</option>
                            @endforeach
                        </select>
                        @error('proveedor_id')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror

                    </label>
                    <!-- Número documento -->
                    <label class="block mt-4 text-sm w-full">
                        <span class="text-gray-700 dark:text-gray-400">
                            Numero documento
                        </span>
                        <input wire:model="num_comprobante" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="">

                        @error('numero_fra')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </label>

                    <!-- Fecha emisión -->
                    <label class="block mt-4 text-sm w-full">
                        <span class="text-gray-700 dark:text-gray-400">
                            Fecha emision
                        </span>
                        <input wire:model="fecha" type="date" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="14/05/1990">
                        @error('fecha')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <!-- Inicio tabla -->
                <div class="w-full overflow-hidden rounded-lg shadow-xs mt-6">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Categoria</th>
                                    <th class="px-4 py-3">Descripcion</th>
                                    <th class="px-4 py-3">Cantidad</th>
                                    <th class="px-4 py-3">Proyecto-Cliente</th>
                                </tr>
                            </thead>

                            <tbody
                                class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <!-- Categoria -->
                                    <td class="text-sm">
                                        <select wire:model="categoria_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                            <option value="">Categoria</option>
                                            @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                            @endforeach
                                        </select>
                                        @error('categoria_id')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <!-- Descripción -->
                                    <td class="text-sm">
                                        <input wire:model="descripcion" type="text" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                                        @error('descripcion')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <!-- Cantidad -->
                                    <td class="text-sm">
                                        <input wire:model.live.lazy="cantidad" type="number" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                                        @error('cantidad')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>

                                    <!-- Proyecto -->
                                    <td class="text-sm">
                                        <select wire:model="proyecto_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                            <option value="">Proyecto-Cliente</option>
                                            @foreach($proyectos as $proyecto)
                                            <option value="{{$proyecto->id}}">{{$proyecto->nombre}} - {{$proyecto->cliente->persona->nombre}} </option>
                                            @endforeach
                                        </select>
                                        @error('proyecto_id')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                </tr>
                            </tbody>
                            <!-- Resumen de totales -->
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="py-3"></td>
                                </tr> <!-- Espaciador -->
                                <tr class="bg-gray-100 dark:bg-gray-800 text-sm text-gray-700 dark:text-gray-300 font-medium border-t-2 border-purple-500">
                                    <td colspan="3"></td> <!-- Ocupa las primeras cuatro columnas y deja espacio -->
                                    <td class="px-4 py-3 text-right text-purple-600 font-bold">Total: {{number_format($cantidad,2)}} €</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>