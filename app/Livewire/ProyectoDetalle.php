<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;
use App\Models\Cliente;
use Livewire\Attributes\Computed;

class ProyectoDetalle extends Component
{
    public $proyecto;
    public $proyecto_id;
    public $nombre;
    public $descripcion;
    public $fecha_inicio, $fecha_final;
    public $cliente_id;
    public $clientes;
    public $modalEditar = false;

    public function mount($id)
    {
        $this->proyecto = Proyecto::with(['cliente.persona', 'facturas.tipo_factura', 'comprobantes'])
            ->findOrFail($id);
        $this->proyecto_id = $id;
    }

    public function abrirModalEditar()
    {
        $this->nombre = $this->proyecto->nombre;
        $this->descripcion = $this->proyecto->descripcion;
        $this->fecha_inicio = optional($this->proyecto->fecha_inicio)->format('Y-m-d');
        $this->fecha_final = optional($this->proyecto->fecha_final)->format('Y-m-d');
        $this->cliente_id = $this->proyecto->cliente->id;
        $this->clientes = Cliente::with('persona')->get();
        $this->modalEditar = true;
    }

    public function cerrarModalEditar()
    {
        $this->modalEditar = false;
        $this->resetErrorBag(); //limpia mensajes de error
        $this->resetValidation(); // limpia errores de validación personalizados
        $this->reset(['nombre', 'descripcion', 'fecha_inicio', 'fecha_final']); //limpia los campos
    }

    public function eliminarProyecto()
    {
        //comprobar que proyecto no tiene documentos asociados
        $proyecto = Proyecto::withCount(['comprobantes', 'facturas'])->findOrFail($this->proyecto_id);
        if ($proyecto->comprobantes_count > 0 || $proyecto->facturas_count > 0) {
            return redirect()->route('proyectos.detalle', ['id' => $this->proyecto_id])->with('exists', 'El proyecto no se puede eliminar porque tiene comprobantes asociados');
        }
        try {
            $this->proyecto->delete();

            //Mensaje flash
            return redirect()->to('/proyectos')->with('success', 'Proyecto eliminado');
        } catch (\Exception $e) {
            return redirect()->to('/proyectos.detalle')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function actualizarProyecto()
    {

        $this->validate([
            'nombre' => 'required | max:45 | min:3',
            'descripcion' => 'nullable|max:255',
            'fecha_inicio' => 'nullable',
            'fecha_final' => 'nullable',
            'cliente_id' => 'required'
        ]);
        try {
            $this->proyecto->nombre = $this->nombre;
            $this->proyecto->descripcion = $this->descripcion;
            $this->proyecto->fecha_inicio = $this->fecha_inicio;
            $this->proyecto->fecha_final = $this->fecha_final;
            $this->proyecto->clientes_id = $this->cliente_id;
            $this->proyecto->save();

            $this->cerrarModalEditar();
            $this->dispatch('$refresh'); //recarga todo el componente
            //Mensaje flash
            return redirect()->to('/proyectos')->with('success', 'Proyecto actualizado');
        } catch (\Exception $e) {
            return redirect()->to('/proyectos')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
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
