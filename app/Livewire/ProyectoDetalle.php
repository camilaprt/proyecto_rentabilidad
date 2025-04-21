<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;
use Livewire\Attributes\Computed;

class ProyectoDetalle extends Component
{
    public $proyecto;

    public function mount($id)
    {
        $this->proyecto = Proyecto::with(['cliente.persona', 'facturas.tipo_factura', 'comprobantes'])
            ->findOrFail($id);
    }
    #[Computed]
    public function resumenProyecto()
    {
        $ingresos = $this->proyecto->facturas->where('tipo_factura.tipo', 'Venta')->sum('base_imp');
        $egresos = $this->proyecto->facturas->where('tipo_factura.tipo', 'Compra')->sum('base_imp') +
            $this->proyecto->comprobantes->sum('cantidad');
        $max = max($ingresos, $egresos, 1);

        return (object) [
            'ingresos' => $ingresos,
            'egresos' => $egresos,
            'beneficio' => $ingresos - $egresos,
            'porcentaje' => (($ingresos - $egresos) / $max) * 100,
            'ingresos_porc' => ($ingresos / $max) * 100,
            'egresos_porc' => ($egresos / $max) * 100,
        ];
    }

    #[Computed]
    public function listaIngresos()
    {
        return $this->proyecto->facturas->where('tipo_factura.tipo', 'Venta');
    }

    #[Computed] //devuelve coleccion indexada. Ej. ['materiales'=>1500, 'sueldos'=>1000]
    public function listaComprasPorCategoria()
    {
        return $this->proyecto->facturas
            ->filter(function ($factura) {
                return $factura->tipo_factura->tipo == 'Compra';
            })
            ->groupBy(function ($factura) {
                return $factura->categoria->nombre;
            })
            ->map(function ($grupo) {
                return $grupo->sum('base_imp');
            });
    }

    #[Computed] //devuelve coleccion indexada. Ej. ['materiales'=>1500, 'sueldos'=>1000]
    public function listaTicketsPorCategoria()
    {
        return $this->proyecto->comprobantes
            ->groupBy(function ($comp) {
                return $comp->categoria->nombre;
            })
            ->map(function ($grupo) {
                return $grupo->sum('cantidad');
            });
    }


    public function render()
    {
        return view('livewire.proyecto-detalle');
    }
}
