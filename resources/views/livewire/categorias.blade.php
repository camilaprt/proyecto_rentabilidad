<div>
    <div>
        <!-- BOTÓN CREAR -->
        <div class="flex justify-between items-center">
            <h2 class="my-6 text-2xl font-semibold text-gray-700">Categorias</h2>
            <button type="button" wire:click="abrirModalCrear" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Nueva Categoria
            </button>
        </div>
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
                    @if($modalCrear) Nueva Categoria @else Editar Categoria @endif
                </h3>

                <!-- Formulario Livewire -->
                <form wire:submit.prevent="{{$modalCrear ? 'crearCategoria' : 'actualizarCategoria'}}">
                    <!-- Nombre -->
                    <label class="block text-sm">
                        <span class="text-gray-700">Nombre</span>
                        <input wire:model="nombre_categoria" class="block w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                    </label>
                    @error('nombre_categoria')
                    <div class="text-red-700 text-xs mt-1">{{ $message }}</div>
                    @enderror

                    <!-- Botones -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" wire:click="{{$modalCrear ? 'cerrarModalCrear' : 'cerrarModalEditar'}}" class="px-4 py-2 text-sm bg-gray-300 text-gray-800 font-medium rounded hover:bg-gray-400 focus:outline-none focus:shadow-outline">
                            Cancelar
                        </button>

                        <!-- Spinner visible durante cualquier carga -->
                        <div
                            wire:loading
                            class="border-gray-300 h-5 w-5 animate-spin rounded-full border-2 border-t-blue-600 mr-2"></div>

                        <button type="submit"
                            wire:loading.attr="disabled" class="ml-2 px-4 py-2 text-sm bg-blue-500 text-white font-medium rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
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
            <table class="max-w-4xl whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3" colspan="3">Nombre</th>
                        <th class="px-4 py-3"></th>
                        <th class="px-4 py-3"></th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @foreach($categorias as $categoria)
                    <tr class="text-gray-700">
                        <td colspan="3" class="px-4 py-3 text-sm">
                            {{$categoria->nombre}}
                        </td>
                        <td><span></span></td>
                        <td><span></span></td>
                        <td colspan="2" class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <!--BOTON EDITAR -->
                                <button wire:click="abrirModalEditar({{$categoria->id}})" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline" aria-label="Edit">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </button>
                                <!--BOTON ELIMINAR -->
                                <button wire:click="eliminarCategoria({{$categoria->id}})" wire:confirm="¿Eliminar categoria?" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline" aria-label="Delete">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>