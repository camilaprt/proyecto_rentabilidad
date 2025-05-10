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
    public $search = '';

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
        $ventas = Factura::with(['tipo_factura', 'cliente.persona', 'proyecto'])
            ->whereHas('tipo_factura', function ($q) {
                $q->where('tipo', 'Venta');
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('numero_fra', 'like', "%{$this->search}%")
                        ->orWhere('descripcion', 'like', "%{$this->search}%")
                        ->orWhereHas('cliente.persona', function ($q) {
                            $q->where('nombre', 'like', "%{$this->search}%");
                        })
                        ->orWhereHas('proyecto', function ($q) {
                            $q->where('nombre', 'like', "%{$this->search}%");
                        });
                });
            })
            ->orderByDesc('fecha')
            ->get();

        $this->ventas = $ventas;
        return view('livewire.ventas');
    }
}
