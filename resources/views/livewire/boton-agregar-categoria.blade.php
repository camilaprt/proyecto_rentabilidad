<div class="space-y-2">
    <button type="button" wire:click="abrirModalCrear">+</button>

    @if($modalCrear)
    <div class="fixed inset-0 z-40 bg-black opacity-50"></div>

    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <!-- Superposición del modal (fondo oscuro) -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>

        <!-- Contenido del Modal -->
        <div class="bg-white rounded-lg shadow-lg p-6 w-72 max-w-xl sm:mx-4 sm:rounded-xl mx-auto z-50 relative">
            <!-- Título -->
            <h3 class="text-xl font-semibold text-gray-700 mb-4">
                Crear Categoria
            </h3>
            <input type="text" wire:model="nueva_categoria" class="block w-24 mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input">
            <!-- Botones -->
            <div class="mt-6 flex justify-end space-x-4">
                <button type="button" wire:click="cerrarModalCrear" class="px-4 py-2 text-sm bg-gray-300 text-gray-800 font-medium rounded hover:bg-gray-400 focus:outline-none focus:shadow-outline">
                    Cancelar
                </button>

                <!-- Spinner visible durante cualquier carga -->
                <div
                    wire:loading
                    class="border-gray-300 h-5 w-5 animate-spin rounded-full border-2 border-t-blue-600 mr-2"></div>

                <button type="button" wire:click="agregarCategoria"
                    wire:loading.attr="disabled" class="ml-2 px-4 py-2 text-sm bg-blue-500 text-white font-medium rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Guardar
                </button>
            </div>
            @error('nueva_categoria')
            <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    @endif

</div>