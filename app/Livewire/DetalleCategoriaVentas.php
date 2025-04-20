<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Factura;

class DetalleCategoriaVentas extends Component
{
    public $ventas;
    public $nombre_proyecto;
    public $categoria;
    public $factura_id;
    public $modalEliminar = false;

    public function mount($id, $categoria)
    {
        $this->categoria = $categoria;
        //traer las facturas
        $this->ventas = Factura::with(['proyecto', 'cliente', 'tipo_factura'])
            ->where('proyectos_id', $id)
            ->whereHas('tipo_factura', fn($q) =>
            $q->where('tipo', 'Venta'))
            ->get();

        //guardar nombre proyecto
        $this->nombre_proyecto = $this->ventas->first()->proyecto->nombre;
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

            return redirect()->to('/ventas')->with('success', 'Factura eliminada');
        } catch (\Exception $e) {
            return redirect()->to('/ventas')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function editarVenta($id, $tipo)
    {
        return redirect()->route('editarfactura', [
            'tipo' => $tipo,
            'id' => $id,
        ]);
    }


    public function render()
    {
        return view('livewire.detalle-categoria-ventas');
    }
}
