<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


use function Laravel\Prompts\alert;

class GestionClientes extends Component
{
    public $clientes;
    public $cliente;
    public $nombre, $direccion, $id_fiscal, $email;
    public $cliente_id, $persona_id;
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
        $this->cliente_id = $id;
        $this->cliente = Cliente::with('persona')->find($id);
        $this->persona_id = $this->cliente->persona_id;
        $this->nombre = $this->cliente->persona->nombre;
        $this->direccion = $this->cliente->persona->direccion;
        $this->email = $this->cliente->persona->email;
        $this->id_fiscal = $this->cliente->persona->id_fiscal;
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
        $this->cliente_id = $id;
    }
    public function cerrarModalEliminar()
    {
        $this->modalEliminar = false;
    }

    //el cliente_id lo completa el modalEliminar al abrirse
    public function eliminarCliente()
    {
        //comprobar que cliente no esta asociado a un proyecto
        if (Cliente::findOrFail($this->cliente_id)->proyectos()->exists()) {
            return redirect()->to('/clientes')->with('exists', 'El cliente no se puede eliminar porque tiene proyecto asociado');
        }
        try {
            DB::transaction(function () {
                $cliente = Cliente::findOrFail($this->cliente_id);
                $cliente->delete();
                $cliente->persona()->delete();
            });
            //Mensaje flash
            return redirect()->to('/clientes')->with('success', 'Cliente eliminado');
        } catch (\Exception $e) {
            return redirect()->to('/clientes')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function actualizarCliente()
    {
        $this->validate([
            'nombre' => 'required | max:45 | min:3',
            'direccion' => 'max:254',
            'id_fiscal' => [
                'required',
                'max:10',
                'min:5',
                Rule::unique('personas', 'id_fiscal')->ignore($this->persona_id),
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('personas', 'email')->ignore($this->persona_id),
            ],
        ]);

        try {
            $this->cliente->persona->nombre = $this->nombre;
            $this->cliente->persona->direccion = $this->direccion;
            $this->cliente->persona->email = $this->email;
            $this->cliente->persona->id_fiscal = $this->id_fiscal;
            $this->cliente->persona->save();
            //Mensaje flash
            return redirect()->to('/clientes')->with('success', 'Cliente actualizado');
        } catch (\Exception $e) {
            return redirect()->to('/clientes')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }


    public function guardarCliente()
    {

        $this->validate([
            'nombre' => 'required | max:45 | min:3',
            'email' => 'nullable|email|max:255|unique:personas,email',
            'direccion' => 'max:254',
            'id_fiscal' => 'required | max:10 | min:5|unique:personas,id_fiscal'
        ]);

        $persona = Persona::create([
            'nombre' => $this->nombre,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'id_fiscal' => $this->id_fiscal,

        ]);

        Cliente::create(['persona_id' => $persona->id]);
        $this->cerrarModalCrear();
        //Mensaje flash
        return redirect()->to('/clientes')->with('success', 'Cliente guardado');
    }

    public function render()
    {
        $this->clientes = Cliente::with('persona')
            ->when($this->search, function ($query) {
                $query->whereHas('persona', function ($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%')
                        ->orWhere('id_fiscal', 'like', '%' . $this->search . '%');
                });
            })
            ->get();
        return view('livewire.gestion-clientes');
    }
}
