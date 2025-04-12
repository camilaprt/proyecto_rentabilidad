<div>




  <!-- BOTÓN CREAR -->
  <div class="flex justify-between items-center">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Clientes</h2>
    <button type="button" wire:click="abrirModalCrear" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
      Nuevo Cliente
    </button>
  </div>

  <!-- MODAL CREAR -->
  <div>
    @if($modalCrear)
    <!-- Overlay -->
    <div class="fixed inset-0 z-40 bg-black opacity-50"></div>

    <div class="fixed inset-0 z-50 flex items-center justify-center ">
      <!-- Superposición del modal (fondo oscuro) -->
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75"></div>

      <!-- Contenido del Modal -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-xl sm:mx-4 sm:rounded-xl mx-auto z-50 relative">
        <!-- Título -->
        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Nuevo Cliente</h3>

        <!-- Formulario Livewire -->
        <form wire:submit.prevent="guardarCliente">
          <!-- Nombre -->
          <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Nombre</span>
            <input wire:model="nombre" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe">
          </label>
          @error('nombre')
          <div class="text-red-700 text-xs mt-1">{{ $message }}</div>
          @enderror
          <!-- Email-->
          <label class="block text-sm mt-4">
            <span class="text-gray-700 dark:text-gray-400">Email</span>
            <input wire:model="email" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="example@domain.com">
          </label>
          @error('email')
          <div class="text-red-700 text-xs mt-1">{{ $message }}</div>
          @enderror
          <!-- Direccion-->
          <label class="block text-sm mt-4">
            <span class="text-gray-700 dark:text-gray-400">Dirección</span>
            <input wire:model="direccion" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Av.Carlemnay 53">
          </label>
          @error('direccion')
          <div class="text-red-700 text-xs mt-1">{{ $message }}</div>
          @enderror

          <!-- NIF-->
          <label class="block text-sm mt-4">
            <span class="text-gray-700 dark:text-gray-400">NIF</span>
            <input wire:model="id_fiscal" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="12345678P">
          </label>
          @error('id_fiscal')
          <div class="text-red-700 text-xs mt-1">{{ $message }}</div>
          @enderror

          <!-- Botones -->
          <div class="mt-6 flex justify-end space-x-4">
            <!-- Botón Cancelar -->
            <button type="button" wire:click="cerrarModalCrear" class="px-4 py-2 text-sm bg-gray-300 text-gray-800 font-medium rounded hover:bg-gray-400 focus:outline-none focus:shadow-outline">
              Cancelar</button>

            <!-- Botón Guardar -->
            <button type="submit" class="ml-2 px-4 py-2 text-sm bg-blue-500 text-white font-medium rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
              Guardar
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
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Nombre</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Dirección</th>
            <th class="px-4 py-3">NIF</th>
            <th class="px-4 py-3">Acciones</th>
          </tr>
        </thead>
        <tbody
          class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">@foreach($clientes as $cliente)
          <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm">
              {{$cliente->persona->nombre}}
            </td>
            <td class="px-4 py-3 text-sm">
              casino@gmail.com
            </td>
            <td class="px-4 py-3 text-sm">
              {{$cliente->persona->direccion}}
            </td>
            <td class="px-4 py-3 text-sm">
              {{$cliente->persona->id_fiscal}}
            </td>
            <td class="px-4 py-3">
              <div class="flex items-center space-x-4 text-sm">
                <button
                  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                  aria-label="Edit">
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                      d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                  </svg>
                </button>
                <button
                  class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                  aria-label="Delete">
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                      clip-rule="evenodd"></path>
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