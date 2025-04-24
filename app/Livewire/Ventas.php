<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Factura;
use App\Models\Tipo_factura;

class Ventas extends Component
{
    public $ventas;
    public $modalEliminar = false;
    public $factura_id;

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

            $this->cerrarModalEliminar();
            return redirect()->to('/ventas')->with('success', 'Factura eliminada');
        } catch (\Exception $e) {
            $this->cerrarModalEliminar();
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
        $this->ventas = Factura::with(['tipo_factura', 'cliente', 'proyecto'])
            ->whereHas('tipo_factura', function ($query) {
                $query->where('tipo', 'Venta');
            })
            ->get();
        return view('livewire.ventas');
    }
}
