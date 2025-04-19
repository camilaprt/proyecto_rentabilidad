<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 ">Detalle {{$categoria}} - {{$nombre_proyecto}}</h2>
    <x-modal-eliminar :modalEliminar="$modalEliminar" />
    <x-tabla-compras :compras="$compras" />
</div>