<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Models\Proyecto;
use App\Models\Cliente;


class Proyectos extends Component
{
    use WithPagination;

    public $nombre, $descripcion, $fecha_inicio, $fecha_final;
    public $cliente_id;
    public $clientes = [];
    public $modalCrear = false;
    public $modalEditar = false;

    public function mount()
    {
        //cargar array de clientes
        $this->clientes = Cliente::with('persona')->get();
    }

    public function abrirModalCrear()
    {
        $this->modalCrear = true;
    }

    public function cerrarModalCrear()
    {
        $this->modalCrear = false;
        $this->resetErrorBag(); //limpia mensajes de error
        $this->resetValidation(); // impia errores de validación personalizados
        $this->reset(['nombre', 'descripcion', 'fecha_inicio', 'fecha_final', 'cliente_id']); //limpia los campos
    }

    public function guardarProyecto()
    {

        $this->validate([
            'nombre' => 'required | max:45 | min:3',
            'descripcion' => 'nullable|max:255',
            'fecha_inicio' => 'nullable',
            'fecha_final' => 'nullable',
            'cliente_id' => 'required'
        ]);

        $proyecto = Proyecto::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_final' => $this->fecha_final,
            'clientes_id' => $this->cliente_id,

        ]);

        $this->cerrarModalCrear();
        //Mensaje flash
        return redirect()->to('/proyectos')->with('success', 'Proyecto creado');
    }

    #[Computed] //esto permite acceder a la funcion como una propiedad "resumenProyectos"
    public function resumenProyectos()
    {
        return Proyecto::with(['cliente.persona', 'facturas.tipo_factura', 'comprobantes'])
            ->paginate(10)
            ->through(function ($proyecto) {
                $ingresos = $proyecto->facturas->where('tipo_factura.tipo', 'Venta')->sum('base_imp');
                $egresos = $proyecto->facturas->where('tipo_factura.tipo', 'Compra')->sum('base_imp') +
                    $proyecto->comprobantes->sum('cantidad');

                $max = max($ingresos, $egresos, 1); //evita division por cero cuando creamos nuevo proyecto
                return (object)[
                    'id' => $proyecto->id,
                    'nombre' => $proyecto->nombre,
                    'cliente' => $proyecto->cliente->persona->nombre,
                    'fecha_inicio' => optional($proyecto->fecha_inicio)->format('d-m-Y'), //optional porque fecha puede ser null
                    'fecha_final' => optional($proyecto->fecha_final)->format('d-m-Y'), //optional porque fecha puede ser null
                    'ingresos' => $ingresos,
                    'egresos' => $egresos,
                    'ingresos_porc' => ($ingresos / $max) * 100,
                    'egresos_porc' => ($egresos / $max) * 100,
                    'beneficio' => $ingresos - $egresos,
                    'porcentaje' => (($ingresos - $egresos) / $max) * 100,

                ];
            });
    }

    public function render()
    {
        return view('livewire.proyectos');
    }
}
