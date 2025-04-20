<?php

namespace App\Livewire;

use App\Models\Comprobante;
use Livewire\Component;
use App\Models\Factura;
use PhpParser\Node\Expr\Cast\Object_;

class Compras extends Component
{
    public $compras;
    public $modalEliminar = false;
    public $factura_id, $ticket_id;
    public $tipo;

    public function abrirModalEliminar($id, $tipo)
    {
        $this->modalEliminar = true;
        $this->tipo = $tipo;

        if ($tipo == 'Compra') {
            $this->factura_id = $id;
        } elseif ($tipo == 'Ticket') {
            $this->ticket_id = $id;
        }
    }

    public function cerrarModalEliminar()
    {
        $this->modalEliminar = false;
    }

    public function eliminarComprobante()
    {
        if ($this->tipo == 'Compra') {
            try {
                $factura = Factura::findOrFail($this->factura_id);
                $factura->delete();

                return redirect()->to('/compras')->with('success', 'Factura eliminada');
            } catch (\Exception $e) {
                return redirect()->to('/compras')->with('error', 'Ocurrió un error: ' . $e->getMessage());
            }
        } elseif ($this->tipo == 'Ticket') {
            try {
                $ticket = Comprobante::findOrFail($this->ticket_id);
                $ticket->delete();

                return redirect()->to('/compras')->with('success', 'Ticket eliminado');
            } catch (\Exception $e) {
                return redirect()->to('/compras')->with('error', 'Ocurrió un error: ' . $e->getMessage());
            }
        }
    }

    public function editarComprobante($id, $tipo)
    {
        if ($tipo == 'Compra') {
            return redirect()->route('editarfactura', [
                'tipo' => $tipo,
                'id' => $id,
            ]);
        } elseif ($tipo == 'Ticket') {
            return redirect()->route('compras.editarticket', [
                'tipo' => $tipo,
                'id' => $id,
            ]);
        };
    }

    //Junta datos de ambas tablas y los normaliza para la vista
    public function cargarCompras()
    {
        // 1. Facturas con tipo = compra
        $facturas = Factura::with(['tipo_factura', 'proveedore'])
            ->whereHas('tipo_factura', function ($query) {
                $query->where('tipo', 'Compra');
            })
            ->get();

        // 2. Comprobantes (todos son compras por defecto)
        $comprobantes = Comprobante::with('tipo_comprobante', 'proveedore.persona')->get();

        // 3. Crear coleccion
        $this->compras = collect();

        // 4. Recorrer, normalizar e insertar fila en compras
        foreach ($facturas as $f) {
            $this->compras->push((object)[
                'id' => $f->id,
                'fecha' => $f->fecha,
                'numero' => $f->numero_fra,
                'tipo' => $f->tipo_factura->tipo, // 'compra'
                'proveedor' => $f->proveedore->persona->nombre ?? '',
                'descripcion' => $f->descripcion,
                'subtotal' => $f->base_imp,
                'total' => $f->total,
                'origen' => 'factura',
            ]);
        }
        foreach ($comprobantes as $c) {
            $this->compras->push((object)[
                'id' => $c->id,
                'fecha' => $c->fecha,
                'numero' => $c->numero_comprobante,
                'tipo' => $c->tipo_comprobante->tipo,
                'proveedor' => $c->proveedore->persona->nombre ?? '',
                'descripcion' => $c->descripcion,
                'subtotal' => $c->cantidad,
                'total' => $c->cantidad,
                'origen' => 'comprobante',

            ]);
        }

        $this->compras->sortByDesc('fecha')->values();
    }

    public function render()
    {
        $this->cargarCompras();
        return view('livewire.compras');
    }
}
