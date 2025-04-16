<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Factura;
use App\Models\Tipo_factura;

class Ventas extends Component
{
    public $ventas;
    public $modalEliminar = false;

    public function editarVenta($id, $tipo)
    {
        return redirect()->route('ventas.editarfactura', [
            'tipo' => $tipo,
            'id' => $id,

        ]);
    }


    public function render()
    {
        $this->ventas = Factura::with(['tipo_factura', 'cliente'])
            ->whereHas('tipo_factura', function ($query) {
                $query->where('tipo', 'Venta');
            })
            ->get();
        return view('livewire.ventas');
    }
}
