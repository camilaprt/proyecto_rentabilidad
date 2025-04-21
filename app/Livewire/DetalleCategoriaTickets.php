<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Factura;
use App\Models\Comprobante;

class DetalleCategoriaTickets extends Component
{
    public $categoria;
    public $compras;
    public $nombre_proyecto;
    public $ticket_id;
    public $modalEliminar = false;

    public function mount($id, $categoria)
    {
        $this->categoria = $categoria;
        //traer los comprobantes
        $comprobantes = Comprobante::with(['proyecto', 'proveedore', 'tipo_comprobante'])
            ->where('proyectos_id', $id)
            ->whereHas('categoria', fn($q) =>
            $q->where('nombre', $categoria))
            ->whereHas('tipo_comprobante', fn($q) =>
            $q->where('tipo', 'Ticket'))
            ->get();

        //guardar nombre proyecto
        $this->nombre_proyecto = $comprobantes->first()->proyecto->nombre;

        //normalizar para usarlos en el componente tabla-compras
        $this->compras = $comprobantes->map(function ($c) {
            return (object)[
                'id' => $c->id,
                'fecha' => $c->fecha,
                'numero' => $c->numero_comprobante,
                'tipo' => $c->tipo_comprobante->tipo ?? '',
                'proveedor' => $c->proveedore->persona->nombre ?? '',
                'descripcion' => $c->descripcion ?? '',
                'subtotal' => $c->cantidad,
                'total' => $c->cantidad,
                'proyecto' => $c->proyecto->nombre ?? '',
                'origen' => 'comprobante',
            ];
        });
    }

    public function abrirModalEliminar($id)
    {
        $this->modalEliminar = true;
        $this->ticket_id = $id;
    }

    public function cerrarModalEliminar()
    {
        $this->modalEliminar = false;
    }

    public function eliminarComprobante()
    {
        try {
            $ticket = Comprobante::findOrFail($this->ticket_id);
            $ticket->delete();

            return redirect()->to('/compras')->with('success', 'Ticket eliminado');
        } catch (\Exception $e) {
            return redirect()->to('/compras')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function editarComprobante($id)
    {
        return redirect()->route('compras.editarticket', [
            'tipo' => 'Ticket',
            'id' => $id,
        ]);
    }

    public function render()
    {
        return view('livewire.detalle-categoria-tickets');
    }
}
