<div>
    <!-- BOTÓN CREAR -->
    <div class="flex justify-between items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">Proyectos</h2>
        <button type="button" wire:click="abrirModalCrear" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Nuevo Proyecto
        </button>
    </div>

    <!-- MODAL CREAR Y EDITAR -->
    <div>
        @if($modalCrear || $modalEditar)
        <!-- Overlay -->
        <div class="fixed inset-0 z-40 bg-black opacity-50"></div>

        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <!-- Superposición del modal (fondo oscuro) -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>

            <!-- Contenido del Modal -->
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xl sm:mx-4 sm:rounded-xl mx-auto z-50 relative">
                <!-- Título -->
                <h3 class="text-xl font-semibold text-gray-700 mb-4">
                    @if($modalCrear) Nuevo Proyecto @else Editar Proyecto @endif
                </h3>

                <!-- Formulario Livewire -->
                <form wire:submit.prevent="{{$modalCrear ? 'guardarProyecto' : 'actualizarProyecto'}}">
                    <!-- Nombre -->
                    <label class="block text-sm">
                        <span class="text-gray-700">Nombre</span>
                        <input wire:model="nombre" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                    </label>
                    @error('nombre')
                    <div class="text-red-700 text-xs mt-1">{{ $message }}</div>
                    @enderror
                    <!-- Fechas -->
                    <div class="flex flex-wrap">
                        <!-- Fecha Inicio-->
                        <label class="block text-sm mt-4 mr-4">
                            <span class="text-gray-700">Fecha Inicio</span>
                            <input type="date" wire:model="fecha_inicio" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" placeholder="Av.Carlemnay 53">
                        </label>
                        @error('')
                        <div class="text-red-700 text-xs mt-1">{{ $message }}</div>
                        @enderror

                        <!-- Fecha Fin-->
                        <label class="block text-sm mt-4">
                            <span class="text-gray-700">Fecha Fin</span>
                            <input type="date" wire:model="fecha_final" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" placeholder="Av.Carlemnay 53">
                        </label>
                        @error('')
                        <div class="text-red-700 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Cliente-->
                    <label class="block text-sm mt-4">
                        <select wire:model="cliente_id" class="block w-full mt-1 text-s form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple">
                            <option value="">Cliente</option>
                            @foreach($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->persona->nombre}}</option>
                            @endforeach
                        </select>
                    </label>
                    @error('proveedor_id')
                    <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                    <!-- Descripcion-->
                    <label class="block text-sm mt-4">
                        <span class="text-gray-700">Descripcion</span>
                        <textarea
                            wire:model="descripcion"
                            rows="4"
                            class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-textarea"
                            placeholder="Escribe una descripción..."></textarea>
                    </label>
                    @error('descripcion')
                    <div class="text-red-700 text-xs mt-1">{{ $message }}</div>
                    @enderror
                    <!-- Botones -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" wire:click="{{$modalCrear ? 'cerrarModalCrear' : 'cerrarModalEditar'}}" class="px-4 py-2 text-sm bg-gray-300 text-gray-800 font-medium rounded hover:bg-gray-400 focus:outline-none focus:shadow-outline">
                            Cancelar
                        </button>

                        <button type="submit" class="ml-2 px-4 py-2 text-sm bg-blue-500 text-white font-medium rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                            @if($modalCrear) Guardar @else Actualizar @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>

    <!-- TABLA -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Proyecto</th>
                        <th class="px-4 py-3"></th>
                        <th class="px-4 py-3">Rentabilidad</th>
                        <th class="px-4 py-3">Fecha Inicio</th>
                        <th class="px-4 py-3">Fecha fin</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($this->resumenProyectos as $item)
                    <tr class="text-gray-700">
                        <td class="px-4 py-4 text-sm text-left">
                            <a class="font-semibold hover:underline font-semibold transition-colors duration-150"
                                href=" {{route('proyectos.detalle',['id'=>$item->id])}}">{{ $item->nombre }}</a>
                            <!--<p class="font-semibold">{{ $item->nombre }}</p>-->
                            <p class="text-xs text-gray-500">{{ $item->cliente }}</p>
                        </td>
                        <td class="px-4 py-4">

                            <!--Uso de alpine JS para manejar la clase dinamica de style en class=bar-fill -->
                            <!-- Ingresos -->
                            <div class="flex items-center justify-center" x-data="{ porc: {{$item->ingresos_porc}} }">
                                <p class="text-xs text-gray-500 mr-2">Entradas</p>
                                <div class="bar-container" style="width: 150px;">
                                    <div class="bar-fill-income" :style=" 'width: ' +porc + '%' "></div><!--esto no da error -->
                                </div>
                                <span class="text-sm text-gray-700 whitespace-nowrap ml-2 text-nowrap">
                                    {{ number_format($item->ingresos, 2) }} €
                                </span>
                            </div>

                            <!-- Egresos -->
                            <div class="flex items-center justify-center" x-data="{ porc: {{$item->egresos_porc}} }">
                                <p class="text-xs text-gray-500 mr-2">Salidas</p>
                                <div class="bar-container" style="width: 150px;">
                                    <div class="bar-fill-expense" :style=" 'width: ' +porc + '%' "></div><!--esto no da error -->
                                </div>
                                <span class="text-sm text-gray-700 whitespace-nowrap ml-2 text-nowrap">
                                    {{ number_format($item->egresos, 2) }} €
                                </span>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <span class="text-sm text-gray-700 whitespace-nowrap ml-2
                                {{$item->porcentaje > 0 ? 'text-green-600' : ($item->porcentaje < 0 ? 'text-red-600' : 'text-gray-600')}}">
                                {{ number_format($item->porcentaje, 1) }} %
                            </span>
                        </td>
                        <td class="px-4 py-4 text-sm">{{$item->fecha_inicio}}</td>
                        <td class="px-4 py-4 text-sm">{{$item->fecha_final}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--Paginacion -->
            <div class="mt-4">
                {{ $this->resumenProyectos->links() }}
            </div>
        </div>
    </div>

</div>