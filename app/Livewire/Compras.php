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

    //Redirige a componente reutilizable CrearFactura
    public function editarFactura($id)
    {
        return redirect()->route('compras.editarfactura', [
            'tipo' => 'Compra',
            'id' => $id,
        ]);
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
