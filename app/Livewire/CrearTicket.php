<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tipo_comprobante;
use App\Models\Categoria;
use App\Models\Comprobante;
use App\Models\Proyecto;
use App\Models\Proveedore;
use Illuminate\Validation\Rule;

class CrearTicket extends Component
{
    public $num_comprobante;
    public $fecha;
    public $cantidad;
    public $descripcion;
    public $proveedor_id, $categoria_id, $proyecto_id, $tipo_comprobante_id;
    public $categorias = [];
    public $proyectos = [];
    public $proveedores = [];

    public $modoEditar = false;
    public $comprobante_id;
    public $comprobanteActual;

    public function mount($id = null)
    {
        $this->tipo_comprobante_id = Tipo_comprobante::where('tipo', 'Ticket')->value('id');
        $this->cargaDatosIniciales();

        if ($id) {
            $this->modoEditar = true;
            $this->comprobante_id = $id;
            $this->cargarComprobante();
        }
    }

    public function cargarComprobante()
    {
        $this->comprobanteActual = Comprobante::findOrFail($this->comprobante_id);

        $this->proveedor_id = $this->comprobanteActual->proveedores_id;
        $this->num_comprobante = $this->comprobanteActual->numero_comprobante;
        $this->fecha = $this->comprobanteActual->fecha->format('Y-m-d');
        $this->categoria_id = $this->comprobanteActual->categorias_id;
        $this->descripcion = $this->comprobanteActual->descripcion;
        $this->cantidad = $this->comprobanteActual->cantidad;
        $this->proyecto_id = $this->comprobanteActual->proyectos_id;
    }

    protected function cargaDatosIniciales()
    {
        $this->categorias = Categoria::all();
        $this->proyectos = Proyecto::with('cliente.persona')->get();
        $this->proveedores = Proveedore::with('persona')->get();
    }

    //Soporta para editar como para guardar nuevo ticket
    public function guardarTicket()
    {
        $this->validate(
            [
                'num_comprobante' => 'nullable |max:20',
                'fecha' => 'required |date',
                'descripcion' => 'nullable| max:254',
                'cantidad' => 'required |numeric| between:0,999999.99',
                'categoria_id' => 'required',
                'proyecto_id' => 'required',
                'proveedor_id' => 'required',
            ],
            //Mensajes de error 
            [
                'fecha.required' => 'Fecha obligatoria.',
                'cantidad.required' => 'Cantidad es obligatoria.',
                'cantidad.numeric' => 'Debe ser un número.',
                'categoria_id.required' => 'Selecciona una categoría.',
                'proyecto_id.required' => 'Selecciona un proyecto.',
                'proveedor_id.required' => 'Selecciona un proveedor.',
            ],
        );

        if ($this->modoEditar) {
            try {
                $this->comprobanteActual->update([
                    'fecha' => $this->fecha,
                    'numero_comprobante' => $this->num_comprobante,
                    'descripcion' => $this->descripcion,
                    'cantidad' => $this->cantidad,
                    'proveedores_id' => $this->proveedor_id,
                    'categorias_id' => $this->categoria_id,
                    'proyectos_id' => $this->proyecto_id,
                ]);
                //Mensaje flash
                return redirect()->to('/compras')->with('success', 'Ticket actualizado');
                $this->modoEditar = false;
            } catch (\Exception $e) {
                return redirect()->to('/compras')->with('error', 'Error al actualizar el ticket' . $e->getMessage());
                $this->modoEditar = false;
            }
        } else {
            try {
                Comprobante::create([
                    'numero_comprobante' => $this->num_comprobante,
                    'fecha' => $this->fecha,
                    'descripcion' => $this->descripcion,
                    'cantidad' => $this->cantidad,
                    'categorias_id' => $this->categoria_id,
                    'proyectos_id' => $this->proyecto_id,
                    'proveedores_id' => $this->proveedor_id,
                    'tipo_comprobante_id' => $this->tipo_comprobante_id,

                ]);

                //Mensaje flash
                return redirect()->to('/compras')->with('success', 'Ticket creado');
            } catch (\Exception $e) {
                return redirect()->to('/compras')->with('error', 'Error al crear el ticket' . $e->getMessage());
            }
        }
    }

    public function render()
    {
        return view('livewire.crear-ticket');
    }
}
