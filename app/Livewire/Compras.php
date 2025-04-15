<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Factura;

class Compras extends Component
{
    public $facturas = [];
    public $comprobantes = [];
    public $gastos = [];
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
    //Redirige a componente reutilizable CrearFactura
    public function editarFactura($id)
    {
        return redirect()->route('compras.editarfactura', [
            'tipo' => 'Compra',
            'id' => $id,
        ]);
    }

    //el cliente_id lo completa el modalEliminar al abrirse
    public function eliminarFactura()
    {
        try {
            $factura = Factura::findOrFail($this->factura_id);
            $factura->delete();

            return redirect()->to('/compras')->with('success', 'Factura eliminada');
        } catch (\Exception $e) {
            return redirect()->to('/compras')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }


    public function render()
    {
        $this->facturas = Factura::with(['tipo_factura', 'proveedore'])
            ->whereHas('tipo_factura', function ($query) {
                $query->where('tipo', 'Compra');
            })
            ->get();
        return view('livewire.compras');
    }
}
