<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Factura;

class DetalleCategoriaCompras extends Component
{
    public $categoria;
    public $compras;
    public $nombre_proyecto;

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



    public function render()
    {
        return view('livewire.detalle-categoria-compras');
    }
}
