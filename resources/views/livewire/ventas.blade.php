<div>
    <!-- GRUPO BOTONES INICIO -->
    <div class="flex justify-between items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">Ventas</h2>
        <div class="flex">
            <a href="{{ route('crearfactura', ['tipo' => 'Venta']) }}"
                class="mr-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Nueva Venta
            </a>
        </div>
    </div>

    <!-- MODAL ELIMINAR -->
    <x-modal-eliminar :modalEliminar="$modalEliminar" />

    <!-- TABLA -->
    <x-tabla-ventas :ventas="$ventas" />
</div>