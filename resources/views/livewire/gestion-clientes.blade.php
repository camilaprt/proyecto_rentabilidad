<div>
    <!-- BOTÓN CREAR -->
    <button class="btn btn-primary mb-3" wire:click="abrirModalCrear">Nuevo Cliente</button>

    <!-- MODAL CREAR -->
    @if($modalCrear)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Nuevo Cliente</h5>
                        <button type="button" class="btn-close" wire:click="cerrarModalCrear">x</button>
                    </div>
                    <div class="modal-body">
                        <label  class="form-label">Nombre</label>
                        <input type="text" class="form-control mb-2" wire:model="nombre">
                        <label  class="form-label">Dirección</label>
                        <input type="text" class="form-control mb-2" wire:model="direccion">
                        <label  class="form-label">NIF</label>
                        <input type="text" class="form-control mb-2" wire:model="id_fiscal">
                    </div>
                    <div class=" modal-footer">
                        <button class="btn btn-secondary" wire:click="cerrarModalCrear">Cancelar</button>
                        <button class="btn btn-success" wire:click="guardarCliente">Guardar</button>
                    </div>
                </div>
            </div>
        </div>       
    @endif





    <!-- TABLA -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered table-sm table-white">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>NIF</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->persona->nombre }}</td>
                            <td>{{ $cliente->persona->direccion }}</td>
                            <td>{{ $cliente->persona->id_fiscal }}</td>
                            <td class="d-flex justify-content-start">
                                <button class="btn btn-sm btn-warning">Editar</button>
                                <button class="btn btn-sm btn-danger ml-1">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>
