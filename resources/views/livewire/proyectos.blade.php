<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700">Proyectos</h2>

    <table class="w-full">
        <thead>
            <tr>
                <th>Proyecto</th>
                <th>Cliente</th>
                <th>Ingresos</th>
                <th>Egresos</th>
                <th>Beneficio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($this->resumenProyectos as $p)
            <tr>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->cliente }}</td>
                <td>{{ number_format($p->ingresos, 2) }} €</td>
                <td>{{ number_format($p->egresos, 2) }} €</td>
                <td class="{{ $p->beneficio >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ number_format($p->beneficio, 2) }} €
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $this->resumenProyectos->links() }}
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Proyecto</th>
                        <th class="px-4 py-3">Ingresos / Gastos</th>
                        <th class="px-4 py-3">Rentabilidad</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach ($this->resumenProyectos as $item)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-sm text-left">
                            <p class="font-semibold">{{ $item->nombre }}</p>
                            <p class="text-xs text-gray-500">{{ $item->cliente }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <!-- Barra de ingresos -->
                            <div class="w-full bg-gray-500 rounded h-2.5 mb-1">
                                <div class="bg-green-700 h-2.5 rounded w-[70%]"></div>
                            </div>
                            <!-- Barra de gastos -->
                            <div class="w-full bg-gray-500 rounded h-2.5">
                                <div class="bg-red-700 h-2.5 rounded w-[70%]"></div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="font-semibold {{ $item->porcentaje >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ number_format($item->porcentaje, 1) }}%
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Barra de prueba adicional -->
    <div class="bar-container mt-4">
        <div class="bar-fill"></div>
    </div>
</div>