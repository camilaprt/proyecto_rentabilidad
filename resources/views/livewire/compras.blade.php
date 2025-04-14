<!-- BOTÓN CREAR -->
<div class="flex justify-between items-center">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Compras</h2>
    <a href="{{ route('compras.crearfactura', ['tipo' => 'Compra']) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Nueva Compra
    </a>
</div>