<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Factura;

class DetalleCategoriaCompras extends Component
{
    public $categoria;
    public $compras;
    public $nombre_proyecto;
    public $factura_id;
    public $modalEliminar = false;

    public function mount($id, $categoria)
    {
        $this->categoria = $categoria;
        //traer las facturas
        $facturas = Factura::with(['proyecto', 'proveedore', 'tipo_factura'])
            ->where('proyectos_id', $id)
            ->whereHas('categoria', fn($q) =>
            $q->where('nombre', $categoria))
            ->whereHas('tipo_factura', fn($q) =>
            $q->where('tipo', 'Compra'))
            ->get();

        //guardar nombre proyecto
        $this->nombre_proyecto = $facturas->first()->proyecto->nombre;

        //normalizarlas para usar en el componente tabla-compras
        $this->compras = $facturas->map(function ($f) {
            return (object)[
                'id' => $f->id,
                'fecha' => $f->fecha,
                'numero' => $f->numero_fra,
                'tipo' => $f->tipo_factura->tipo ?? '',
                'proveedor' => $f->proveedore->persona->nombre ?? '',
                'descripcion' => $f->descripcion ?? '',
                'subtotal' => $f->base_imp,
                'total' => $f->total,
                'proyecto' => $f->proyecto->nombre ?? '',
                'origen' => 'factura',
            ];
        });
    }

    public function abrirModalEliminar($id)
    {
        $this->modalEliminar = true;
        $this->factura_id = $id;
    }

    public function cerrarModalEliminar()
    {
        $this->modalEliminar = false;
    }

    public function eliminarComprobante()
    {
        try {
            $factura = Factura::findOrFail($this->factura_id);
            $factura->delete();

            return redirect()->to('/compras')->with('success', 'Factura eliminada');
        } catch (\Exception $e) {
            return redirect()->to('/compras')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function editarComprobante($id)
    {
        return redirect()->route('compras.editarfactura', [
            'tipo' => 'Compra',
            'id' => $id,
        ]);
    }

    public function render()
    {
        return view('livewire.detalle-categoria-compras');
    }
}
