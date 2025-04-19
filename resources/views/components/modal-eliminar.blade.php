<!-- MODAL ELIMINAR -->
<div>
    @if($modalEliminar)
    <!-- Overlay -->
    <div class="fixed inset-0 z-40 bg-black opacity-50"></div>

    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <!-- Superposición del modal (fondo oscuro) -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>

        <!-- Contenido del Modal -->
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xl sm:mx-4 sm:rounded-xl mx-auto z-50 relative">
            <!-- Título -->
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Eliminar Registro</h3>

            <!-- Descripción -->
            <p class="text-sm text-gray-700  mb-4">
                ¿Está seguro de que desea eliminar este registro?
            </p>

            <!-- Botones -->
            <div class="mt-6 flex justify-end space-x-4">
                <!-- Botón Cancelar -->
                <button
                    type="button"
                    wire:click="cerrarModalEliminar"
                    class="px-4 py-2 text-sm bg-gray-300 text-gray-800 font-medium rounded hover:bg-gray-400 focus:outline-none focus:shadow-outline">
                    Cancelar
                </button>

                <!-- Botón Eliminar -->
                <button
                    type="button"
                    wire:click="eliminarComprobante"
                    class="ml-2 px-4 py-2 text-sm bg-red-600 text-white font-medium rounded hover:bg-red-700 focus:outline-none focus:shadow-outline">
                    Eliminar
                </button>
            </div>
        </div>
    </div>
    @endif
</div>