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