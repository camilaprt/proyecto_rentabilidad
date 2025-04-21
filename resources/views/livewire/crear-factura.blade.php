<div>
    <form wire:submit.prevent="guardarFactura">
        <!-- BOTÓN CREAR Y EDITAR -->
        <!-- Encabezado dinámico sin colores ni etiquetas -->
        <div class="flex justify-between items-center">
            <h2 class="my-6 text-2xl font-semibold text-gray-700">
                {{ $modoEditar ? 'Editar' : 'Nueva' }} {{ ucfirst($tipo) }}
            </h2>
            <button type="submit"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 
        bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 
        focus:outline-none focus:shadow-outline-purple">
                {{ $modoEditar ? 'Actualizar' : 'Guardar' }}
            </button>
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
                    <!-- Proveedor o Cliente Dinámico -->
                    <label class="block mt-4 text-sm w-full">
                        <span class="text-gray-700">
                            {{$tipo == 'Venta' ? 'Cliente' : 'Proveedor'}}
                        </span>
                        @if($tipo == 'Compra')<!-- COMPRA-->
                        <select wire:model="proveedor_id" class="block w-full mt-1 text-s form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple">
                            <option value="">Proveedor</option>
                            @foreach($proveedores as $proveedor)
                            <option value="{{$proveedor->id}}">{{$proveedor->persona->nombre}}</option>
                            @endforeach
                        </select>
                        @error('proveedor_id')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                        @else <!-- VENTA-->
                        <select wire:model="cliente_id" class="block w-full mt-1 text-sm form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple ">
                            <option value="">Cliente</option>
                            @foreach($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->persona->nombre}}</option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                        @endif

                    </label>
                    <!-- Número documento -->
                    <label class="block mt-4 text-sm w-full">
                        <span class="text-gray-700">
                            Numero documento
                        </span>
                        <input wire:model="numero_fra" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" placeholder="FRA552684">
                        @error('numero_fra')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </label>

                    <!-- Fecha emisión -->
                    <label class="block mt-4 text-sm w-full">
                        <span class="text-gray-700">
                            Fecha emision
                        </span>
                        <input wire:model="fecha" type="date" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" placeholder="14/05/1990">
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
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                    <th class="px-4 py-3">Categoria</th>
                                    <th class="px-4 py-3">Descripcion</th>
                                    <th class="px-4 py-3">Base Imponible</th>
                                    <th class="px-4 py-3">Impuesto</th>
                                    <th class="px-4 py-3">Proyecto-Cliente</th>
                                </tr>
                            </thead>

                            <tbody
                                class="bg-white divide-y ">
                                <tr class="text-gray-700 ">
                                    <!-- Categoria -->
                                    <td class="text-sm">
                                        <select wire:model="categoria_id" class="block w-full mt-1 text-sm form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple ">
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
                                        <input wire:model="descripcion" type="text" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input">
                                        @error('descripcion')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <!-- Base Imponible -->
                                    <td class="text-sm">
                                        <input wire:model.live.debounce.500ms="base_imp" type="number" class="block w-24 mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input">
                                        @error('base_imp')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <!-- Tipo impuesto -->
                                    <td class="text-sm">
                                        <select wire:model.live="tipo_impuesto_id" class="block w-full mt-1 text-sm form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple ">
                                            <option value="">IVA</option>
                                            @foreach($tipos_impuesto as $tipo)
                                            <option value="{{$tipo->id}}">{{$tipo->tipo_IVA}}%</option>
                                            @endforeach
                                        </select>
                                        @error('tipo_impuesto_id')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <!-- Proyecto -->
                                    <td class="text-sm">
                                        @if($proyecto_seleccionado)
                                        <label class="text-xs text-gray-500 mb-1 block">Proyecto vinculado</label>
                                        <div class="py-2 px-3 bg-gray-100 rounded text-sm text-gray-800">
                                            {{ $proyecto_seleccionado->nombre }} – {{ $proyecto_seleccionado->cliente->persona->nombre }}
                                        </div>
                                        @else
                                        <select wire:model="proyecto_id" class="block w-full mt-1 text-sm form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple">
                                            <option value="">Proyecto-Cliente</option>
                                            @foreach($proyectos as $proyecto)
                                            <option value="{{$proyecto->id}}">{{$proyecto->nombre}} - {{$proyecto->cliente->persona->nombre}} </option>
                                            @endforeach
                                        </select>
                                        @error('proyecto_id')
                                        <span class="text-red-600 text-xs">{{ $message }}</span>
                                        @enderror
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            <!-- Resumen de totales -->
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="py-3"></td>
                                </tr> <!-- Espaciador -->
                                <tr class="bg-gray-100 text-sm text-gray-700 font-medium border-t-2 border-purple-500">
                                    <td colspan="2"></td> <!-- Ocupa las primeras dos columnas y deja espacio -->
                                    <td class="px-4 py-3 text-right"></td>
                                    <td class="px-4 py-3 text-right">IVA: {{number_format($base_imp * ($iva/100),2)}} €</td>
                                    <td class="px-4 py-3 text-right text-purple-600 font-bold">Total: {{number_format($base_imp * (1 + $iva/100),2)}} €</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>