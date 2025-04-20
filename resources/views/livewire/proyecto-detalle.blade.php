<div>
    <h4 class="mb-4 text-lg font-semibold text-gray-600">
        {{$proyecto->nombre}}
    </h4>
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



</div>