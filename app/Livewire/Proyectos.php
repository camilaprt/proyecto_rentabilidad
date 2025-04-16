<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Models\Proyecto;


class Proyectos extends Component
{
    use WithPagination;

    #[Computed]
    public function resumenProyectos()
    {
        return Proyecto::with(['cliente.persona', 'facturas.tipo_factura', 'comprobantes'])
            ->paginate(10)
            ->through(function ($proyecto) {
                $ingresos = $proyecto->facturas->where('tipo_factura.tipo', 'Venta')->sum('base_imp');
                $egresos = $proyecto->facturas->where('tipo_factura.tipo', 'Compra')->sum('base_imp') +
                    $proyecto->comprobantes->sum('cantidad');


                return (object)[
                    'id' => $proyecto->id,
                    'nombre' => $proyecto->nombre,
                    'cliente' => $proyecto->cliente->persona->nombre,
                    'ingresos' => $ingresos,
                    'egresos' => $egresos,
                    'ingresos_porc' => $ingresos / 100,
                    'egresos_porc' => $egresos / 100,
                    'beneficio' => $ingresos - $egresos,
                    'porcentaje' => (($ingresos - $egresos) / $ingresos) * 100,

                ];
            });
    }


    public function render()
    {
        return view('livewire.proyectos');
    }
}
