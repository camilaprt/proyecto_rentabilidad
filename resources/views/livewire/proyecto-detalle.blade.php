<div>

    <div class="flex justify-between items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">{{$proyecto->nombre}}</h2>
        <button wire:click="abrirModalEditar">Editar</button>
        <!-- Uso de Alpine JS para manejar dropdown -->
        <div x-data="{ open: false}" class="relative">
            <button
                @click="open = !open"
                class="flex items-center gap-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Agregar a proyecto
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 ml-2"
                    :class="{ 'rotate-180': open }"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

            <div
                x-show="open"
                @click.away="open = false"
                x-transition
                class="absolute right-0 mt-2 w-52 bg-white rounded-md shadow-lg z-50">
                <a href="{{ route('crearfactura', ['tipo' => 'Compra', 'proyecto_id' => $proyecto->id]) }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Factura de Compra
                </a>
                <a href="{{ route('compras.crearticket', ['tipo' => 'Compra', 'proyecto_id' => $proyecto->id]) }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Ticket
                </a>
                <a href="{{ route('crearfactura', ['tipo' => 'Venta', 'proyecto_id' => $proyecto->id]) }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Factura de Venta
                </a>

            </div>

        </div>
    </div>
    <div class="contenedor-principal">
        <!-- Bloque inicial -->
        <div class="resumen-grid-barra">
            <!-- Margen de rentabilidad -->
            <div class="profit-box">
                <h2>{{ number_format($this->resumenProyecto->porcentaje, 1) }} %</h2>
                <p>Margen rentabilidad</p>
            </div>

            <!-- Barras -->
            <div class="bar-section">
                <!-- Ingresos -->
                <div class="bar-row">
                    <span class="bar-label">Entradas</span>
                    <div class="bar-container" x-data="{ porc: {{$this->resumenProyecto->ingresos_porc}} }">
                        <div class="bar-fill-income" :style=" 'width: ' +porc + '%' "></div>
                    </div>
                    <span class="bar-amount">{{number_format($this->resumenProyecto->ingresos,2)}}€</span>
                </div>

                <!-- Egresos -->
                <div class="bar-row">
                    <span class="bar-label">Salidas</span>
                    <div class="bar-container" x-data="{ porc: {{$this->resumenProyecto->egresos_porc}} }">
                        <div class="bar-fill-expense" :style=" 'width: ' +porc + '%' "></div>
                    </div>
                    <span class="bar-amount">{{number_format($this->resumenProyecto->egresos,2)}}€</span>
                </div>
            </div>
        </div>


        <!-- Bloque tres tarjetas -->
        <div class="resumen-grid">
            <div class="resumen-card">
                <h2 style="color: green;">{{number_format($this->resumenProyecto->ingresos,2)}} €</h2>
                <p>Ingresos</p>
            </div>
            <div class="resumen-card">
                <h2 style="color: teal;">{{number_format($this->resumenProyecto->egresos,2)}} €</h2>
                <p>Egresos</p>
            </div>
            <div class="resumen-card">
                <h2>{{number_format($this->resumenProyecto->beneficio,2)}} €</h2>
                <p>Beneficio</p>
            </div>
        </div>

        <!-- Listas debajo -->
        <div class="listas-detalle">
            <!-- Detalle ingresos -->
            <div class="lista">
                <h3>Facturas de venta</h3>
                @foreach($this->listaIngresos as $ventas)
                <div class="lista-item">
                    <a href="{{ route('proyectos.detalle.ventas', ['id' => $proyecto->id,'categoria' => $ventas->tipo_factura->tipo]) }}">{{$ventas->numero_fra}}</a>
                    <span>{{number_format($ventas->base_imp,2)}} €</span>
                </div>
                @endforeach
            </div>

            <!-- Detalle egresos -->
            <div class="lista">
                <h3>Facturas de compra</h3>
                @foreach($this->listaComprasPorCategoria as $compra => $total)
                <div class="lista-item">
                    <a href="{{ route('proyectos.detalle.compras', ['id' => $proyecto->id,'categoria' => $compra]) }}">{{$compra}}</a>
                    <span>{{number_format($total,2)}} €</span>
                </div>
                @endforeach
                <h3>Tickets</h3>
                @foreach($this->listaTicketsPorCategoria as $compra => $total)
                <div class="lista-item">
                    <a href="{{ route('proyectos.detalle.tickets', ['id' => $proyecto->id,'categoria' => $compra]) }}">{{$compra}}</a>
                    <span>{{number_format($total,2)}} €</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- MODAL CREAR Y EDITAR -->
    <x-modal-crear-editar-proyecto
        :mostrar="$modalEditar"
        :modo="'editar' "
        :clientes="$clientes"
        accionEditar="actualizarProyecto"
        cerrarEditar="cerrarModalEditar" />

</div>