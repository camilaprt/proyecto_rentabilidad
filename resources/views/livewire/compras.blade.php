<div>
    <!-- GRUPO BOTONES INICIO -->
    <div class="flex justify-between items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 ">Compras</h2>
        <div class="flex ">
            <a href="{{ route('compras.crearfactura', ['tipo' => 'Compra']) }}"
                class="mr-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Compra +
            </a>
            <a href="{{ route('compras.crearticket')}}"
                class="mr-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Ticket +
            </a>
        </div>
    </div>
    <!-- MODAL ELIMINAR -->
    <x-modal-eliminar :modalEliminar="$modalEliminar" />
    <!-- TABLA -->
    <x-tabla-compras :compras="$compras" />
</div>