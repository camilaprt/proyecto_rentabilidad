<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;


use function Laravel\Prompts\alert;

class GestionClientes extends Component
{
    public $clientes;
    public $nombre, $direccion, $id_fiscal, $email;
    public $cliente_id, $persona_id;
    public $modalCrear = false;
    public $modalEditar = false;
    public $modalEliminar = false;

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
        try {
            DB::transaction(function () {
                $cliente = Cliente::findOrFail($this->cliente_id);
                $cliente->persona()->delete();
                $cliente->delete();
            });
            return redirect()->to('/')->with('success', 'Cliente eliminado');
        } catch (\Exception $e) {
            return redirect()->to('/')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }


    public function guardarCliente()
    {

        $this->validate([
            'nombre' => 'required | max:45 | min:3',
            'email' => 'nullable|email|max:255|unique:personas,email',
            'direccion' => 'max:45',
            'id_fiscal' => 'required | max:10 | min:5'
        ]);

        $persona = Persona::create([
            'nombre' => $this->nombre,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'id_fiscal' => $this->id_fiscal,

        ]);

        Cliente::create(['persona_id' => $persona->id]);
        $this->cerrarModalCrear();
        session()->flash('success', 'Cliente guardado exitosamente.');
        return redirect()->to('/');
    }

    public function render()
    {
        $this->clientes = Cliente::with('persona')->get();
        return view('livewire.gestion-clientes');
    }
}
