<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tipo_factura;
use App\Models\Tipo_impuesto;
use App\Models\Categoria;
use App\Models\Proyecto;
use App\Models\Proveedore;
use App\Models\Cliente;
use App\Models\Factura;
use Illuminate\Validation\Rule;

class CrearFactura extends Component
{
    public $tipo = ""; //define tipo de factura: compra o venta 
    public $tipo_factura_id, $proyecto_id, $categoria_id, $tipo_impuesto_id, $proveedor_id, $cliente_id;
    public $numero_fra, $fecha, $descripcion, $base_imp, $proyecto_seleccionado;
    public $iva = 0;
    public $tipos_impuesto = [];
    public $categorias = [];
    public $proyectos = [];
    public $proveedores = []; //traerá si tipo es de compra
    public $clientes = []; //traerá si tipo es de venta

    public $modoEditar = false;
    public $factura_id;
    public $facturaActual;

    public function mount($tipo, $id = null, $proyecto_id = null)
    {
        $this->tipo = $tipo; //compra o venta
        $this->proyecto_id = $proyecto_id; //viene desde componente ProyectoDetalle
        $this->cargaDatosIniciales();

        if ($id) {
            $this->modoEditar = true;
            $this->factura_id = $id;
            $this->cargarFactura();
        }
    }

    public function cargarFactura()
    {

        $this->facturaActual = Factura::findOrFail($this->factura_id);

        $this->proveedor_id = $this->facturaActual->proveedores_id;
        $this->cliente_id = $this->facturaActual->clientes_id;
        $this->numero_fra = $this->facturaActual->numero_fra;
        $this->fecha = $this->facturaActual->fecha->format('Y-m-d');;
        $this->categoria_id = $this->facturaActual->categorias_id;
        $this->descripcion = $this->facturaActual->descripcion;
        $this->base_imp = $this->facturaActual->base_imp;
        $this->tipo_impuesto_id = $this->facturaActual->tipo_impuesto_id;
        $this->proyecto_id = $this->facturaActual->proyectos_id;
        $this->actualizarIva();
    }


    protected function cargaDatosIniciales()
    {
        //Trae id de compra o venta
        $this->tipo_factura_id = Tipo_factura::where('tipo', $this->tipo)->value('id');
        $this->tipos_impuesto = Tipo_impuesto::all();
        if ($this->proyecto_id) {
            $this->proyecto_seleccionado = Proyecto::with('cliente.persona')->find($this->proyecto_id);
        } else {
            $this->proyectos = Proyecto::with('cliente.persona')->get();
        }


        if ($this->tipo === 'Compra') {
            $this->proveedores = Proveedore::with('persona')->get();
            $this->categorias = Categoria::all();
            $this->clientes = []; // vacío por claridad
        } elseif ($this->tipo === 'Venta') {
            $this->clientes = Cliente::with('persona')->get();
            $this->proveedores = []; // vacío por claridad
        }
    }

    public function actualizarIva()
    {
        $this->iva = Tipo_impuesto::find($this->tipo_impuesto_id)?->tipo_IVA ?? 0;
    }

    // Esta función se ejecuta automáticamente cuando cambia tipo_impuesto_id. Magic property
    public function updated($propertyName)
    {
        if ($propertyName === 'tipo_impuesto_id') {
            $this->actualizarIva();
        }
    }

    //Soporta para editar como para guardar nueva factura
    public function guardarFactura()
    {
        $rules = [
            'numero_fra' => [
                'required',
                'max:20',
                Rule::unique('facturas', 'numero_fra')->ignore($this->factura_id),
            ],
            'fecha' => 'required |date',
            'descripcion' => 'nullable| max:254',
            'base_imp' => 'required |numeric | between:0,999999.99',
            'tipo_impuesto_id' => 'required',
            'proyecto_id' => 'required',
        ];

        if ($this->tipo === 'Compra') {
            $rules['proveedor_id'] = 'required';
            $rules['categoria_id'] = 'required'; //obligatorio en compras
        } elseif ($this->tipo === 'Venta') {
            $rules['cliente_id'] = 'required';
            $rules['categoria_id'] = 'nullable';
        }
        //Mensajes de error
        $this->validate($rules, [
            'numero_fra.required' => 'Número de factura obligatorio.',
            'numero_fra.unique' => 'Número de factura ya existe.',
            'fecha.required' => 'Fecha obligatoria.',
            'base_imp.required' => 'La base es obligatoria.',
            'base_imp.numeric' => 'Debe ser un número.',
            'tipo_impuesto_id.required' => 'Tipo de IVA obligatorio.',
            'categoria_id.required' => 'Selecciona una categoría.',
            'proyecto_id.required' => 'Selecciona un proyecto.',
            'proveedor_id.required' => 'Selecciona un proveedor.',
            'cliente_id.required' => 'Selecciona un cliente.',

        ]);

        $total = $this->base_imp * (1 + ($this->iva / 100));

        if ($this->modoEditar) {
            try {
                $this->facturaActual->update([
                    'fecha' => $this->fecha,
                    'numero_fra' => $this->numero_fra,
                    'descripcion' => $this->descripcion,
                    'base_imp' => $this->base_imp,
                    'total' => $total,
                    'tipo_factura_id' => $this->tipo_factura_id,
                    'proveedores_id' => $this->tipo === 'Compra' ? $this->proveedor_id : null,
                    'clientes_id' => $this->tipo === 'Venta' ? $this->cliente_id : null,
                    'categorias_id' => $this->categoria_id,
                    'proyectos_id' => $this->proyecto_id,
                    'tipo_impuesto_id' => $this->tipo_impuesto_id,
                ]);

                $this->modoEditar = false;
                //Mensaje flash
                if ($this->tipo == 'Compra') {
                    return redirect()->to('/compras')->with('success', 'Factura de Compra Actualizada');
                } elseif ($this->tipo == 'Venta') {
                    return redirect()->to('/ventas')->with('success', 'Factura de Venta Actualizada');
                }
            } catch (\Exception $e) {
                if ($this->tipo == 'Compra') {
                    return redirect()->to('/compras')->with('error', 'Error al registrar la factura' . $e->getMessage());
                } elseif ($this->tipo == 'Venta') {
                    return redirect()->to('/ventas')->with('error', 'Error al registrar la factura' . $e->getMessage());
                }
            }
        } else {
            try {
                Factura::create([
                    'numero_fra' => $this->numero_fra,
                    'fecha' => $this->fecha,
                    'descripcion' => $this->descripcion,
                    'base_imp' => $this->base_imp,
                    'total' => $total,
                    'tipo_factura_id' => $this->tipo_factura_id,
                    'tipo_impuesto_id' => $this->tipo_impuesto_id,
                    'categorias_id' => $this->categoria_id,
                    'proyectos_id' => $this->proyecto_id,
                    'proveedores_id' => $this->tipo === 'Compra' ? $this->proveedor_id : null,
                    'clientes_id' => $this->tipo === 'Venta' ? $this->cliente_id : null,
                ]);

                //Redireccion si viene desde un proyecto
                if ($this->proyecto_seleccionado) {
                    return redirect()->route('proyectos.detalle', $this->proyecto_id)
                        ->with('success', 'Factura de ' . $this->tipo . ' registrada ');
                }

                //Redireccion segun tipo si NO viene desde proyecto
                if ($this->tipo == 'Compra') {
                    return redirect()->to('/compras')->with('success', 'Factura de compra registrada');
                } elseif ($this->tipo == 'Venta') {
                    return redirect()->to('/ventas')->with('success', 'Factura de venta registrada');
                }
            } catch (\Exception $e) {

                if ($this->proyecto_seleccionado) {
                    return redirect()->route('proyectos.detalle', $this->proyecto_id)
                        ->with('error', 'Error al registrar la factura: ' . $e->getMessage());
                }

                if ($this->tipo == 'Compra') {
                    return redirect()->to('/compras')->with('error', 'Error al registrar la factura' . $e->getMessage());
                } elseif ($this->tipo == 'Venta') {
                    return redirect()->to('/ventas')->with('error', 'Error al registrar la factura' . $e->getMessage());
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.crear-factura');
    }
}
