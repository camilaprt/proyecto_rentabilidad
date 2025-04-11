<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Cliente;

use function Laravel\Prompts\alert;

class GestionClientes extends Component
{
    public $clientes;
    public $nombre, $direccion, $id_fiscal;
    public $cliente_id, $persona_id;
    public $modalCrear = false;
    public $modalEditar = false;

    public function abrirModalCrear()
    {
        $this->modalCrear = true;
    }
    public function cerrarModalCrear()
    {
        $this->modalCrear = false;
        $this->resetErrorBag(); //limpia mensajes de error
        $this->resetValidation(); // impia errores de validación personalizados
        $this->reset(['nombre', 'direccion', 'id_fiscal']); //limpia los campos
    }


    public function guardarCliente()
    {

        $this->validate([
            'nombre' => 'required | max:45 | min:3',
            'direccion' => 'max:45',
            'id_fiscal' => 'required | max:10 | min:5'
        ]);


        $persona = Persona::create([
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'id_fiscal' => $this->id_fiscal
        ]);

        Cliente::create(['persona_id' => $persona->id]);
        $this->cerrarModalCrear();
        session()->flash('message', 'Cliente guardado exitosamente.');
        return redirect()->to('/');
    }

    public function render()
    {
        $this->clientes = Cliente::with('persona')->get();
        return view('livewire.gestion-clientes');
    }
}
