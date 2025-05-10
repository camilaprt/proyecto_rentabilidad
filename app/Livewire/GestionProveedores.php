<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Proveedore;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class GestionProveedores extends Component
{
    public $proveedores;
    public $proveedor;
    public $nombre, $direccion, $id_fiscal, $email;
    public $proveedor_id, $persona_id;
    public $modalCrear = false;
    public $modalEditar = false;
    public $modalEliminar = false;
    public $search = '';

    public function abrirModalCrear()
    {
        $this->modalCrear = true;
    }
    public function cerrarModalCrear()
    {
        $this->modalCrear = false;
        $this->resetErrorBag(); //limpia mensajes de error
        $this->resetValidation(); // impia errores de validación personalizados
        $this->reset(['nombre', 'direccion', 'id_fiscal', 'email']); //limpia los campos
    }

    public function abrirModalEditar($id)
    {
        $this->proveedor_id = $id;
        $this->proveedor = Proveedore::with('persona')->find($id);
        $this->persona_id = $this->proveedor->persona_id;
        $this->nombre = $this->proveedor->persona->nombre;
        $this->direccion = $this->proveedor->persona->direccion;
        $this->email = $this->proveedor->persona->email;
        $this->id_fiscal = $this->proveedor->persona->id_fiscal;
        $this->modalEditar = true;
    }
    public function cerrarModalEditar()
    {
        $this->modalEditar = false;
        $this->resetErrorBag(); //limpia mensajes de error
        $this->resetValidation(); // limpia errores de validación personalizados
        $this->reset(['nombre', 'direccion', 'id_fiscal', 'email']); //limpia los campos
    }

    public function abrirModalEliminar($id)
    {
        $this->modalEliminar = true;
        $this->proveedor_id = $id;
    }
    public function cerrarModalEliminar()
    {
        $this->modalEliminar = false;
    }

    //el proveedor_id lo completa el modalEliminar al abrirse
    public function eliminarProveedor()
    {
        //comprobar que proveedor no tiene comprobantes creados
        $comprobantes = Proveedore::withCount(['comprobantes', 'facturas'])->findOrFail($this->proveedor_id);
        if ($comprobantes->comprobantes_count > 0 || $comprobantes->facturas_count > 0) {
            return redirect()->to('/proveedores')->with('exists', 'El proveedor no se puede eliminar porque tiene comprobantes asociados');
        }
        try {
            DB::transaction(function () {
                $proveedor = Proveedore::findOrFail($this->proveedor_id);
                $proveedor->delete();
                $proveedor->persona()->delete();
            });
            //Mensaje flash
            return redirect()->to('/proveedores')->with('success', 'Proveedor eliminado');
        } catch (\Exception $e) {
            return redirect()->to('/Proveedores')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function actualizarProveedor()
    {
        $this->validate([
            'nombre' => 'required | max:45 | min:3',
            'direccion' => 'max:254',
            'id_fiscal' => 'required | max:10 | min:5',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('personas', 'email')->ignore($this->persona_id),
            ],
        ]);

        try {
            $this->proveedor->persona->nombre = $this->nombre;
            $this->proveedor->persona->direccion = $this->direccion;
            $this->proveedor->persona->email = $this->email;
            $this->proveedor->persona->id_fiscal = $this->id_fiscal;
            $this->proveedor->persona->save();
            //Mensaje flash
            return redirect()->to('/proveedores')->with('success', 'Proveedor actualizado');
        } catch (\Exception $e) {
            return redirect()->to('/proveedores')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function guardarProveedor()
    {

        $this->validate([
            'nombre' => 'required | max:45 | min:3',
            'email' => 'nullable|email|max:255|unique:personas,email',
            'direccion' => 'max:254',
            'id_fiscal' => 'required | max:10 | min:5'
        ]);

        $persona = Persona::create([
            'nombre' => $this->nombre,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'id_fiscal' => $this->id_fiscal,

        ]);

        Proveedore::create(['persona_id' => $persona->id]);
        $this->cerrarModalCrear();
        //Mensaje flash
        return redirect()->to('/proveedores')->with('success', 'Proveedor guardado');
    }


    public function render()
    {
        $this->proveedores = Proveedore::with('persona')
            ->when($this->search, function ($query) {
                $query->whereHas('persona', function ($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%')
                        ->orWhere('id_fiscal', 'like', '%' . $this->search . '%');
                });
            })
            ->get();
        return view('livewire.gestion-proveedores');
    }
}
