<div>
    <!-- BOTÓN CREAR -->
    <div class="flex justify-between items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">Proyectos</h2>
        <button type="button" wire:click="abrirModalCrear" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Nuevo Proyecto
        </button>
    </div>

    <!-- MODAL CREAR Y EDITAR -->
    <x-modal-crear-editar-proyecto
        :mostrar="$modalCrear"
        :modo="'crear'"
        :clientes="$clientes"
        accionCrear="guardarProyecto"
        cerrarCrear="cerrarModalCrear" />

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