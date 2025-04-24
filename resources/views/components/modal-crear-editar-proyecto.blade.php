<div>
    <div>
        @if($mostrar)
        <!-- Overlay -->
        <div class="fixed inset-0 z-40 bg-black opacity-50"></div>

        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <!-- Superposición del modal (fondo oscuro) -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>

            <!-- Contenido del Modal -->
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-xl sm:mx-4 sm:rounded-xl mx-auto z-50 relative">
                <!-- Título -->
                <h3 class="text-xl font-semibold text-gray-700 mb-4">
                    {{ $modo === 'crear' ? 'Nuevo Proyecto' : 'Editar Proyecto' }}
                </h3>

                <!-- Formulario Livewire -->
                <form wire:submit.prevent="{{ $modo === 'crear' ? $accionCrear : $accionEditar }}">
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
                    @error('cliente_id')
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
                        <button type="button" wire:click="{{ $modo === 'crear' ? $cerrarCrear : $cerrarEditar }}" class="px-4 py-2 text-sm bg-gray-300 text-gray-800 font-medium rounded hover:bg-gray-400 focus:outline-none focus:shadow-outline">
                            Cancelar
                        </button>

                        <button type="submit" class="ml-2 px-4 py-2 text-sm bg-blue-500 text-white font-medium rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                            {{ $modo === 'crear' ? 'Guardar' : 'Actualizar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>


</div>