<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persona;
use App\Models\Cliente;


class GestionClientes extends Component
{
    public $clientes;
    public $nombre, $direccion, $id_fiscal;
    public $cliente_id, $persona_id;
    public $modalCrear = false;
    public $modalEditar = false;

    public function abrirModalCrear(){
        $this->modalCrear = true;
    }
     public function cerrarModalCrear(){
        $this->modalCrear = false;
    }

    public function guardarCliente(){

        $this->validate([
            'nombre' => 'required | max:45 | min:3',
            'direccion' =>'max:45',
            'id_fiscal' =>'required | max:10 | min:5'
        ]);


        $persona = Persona::create([
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'id_fiscal' => $this->id_fiscal
        ]);
        
        Cliente::create(['persona_id' => $persona->id]);
        dump("cliente creado");
        $this->cerrarModalCrear();
        $this->resetCampos();


    }

    public function resetCampos(){
        $this->nombre = "";
        $this->direccion = "";
        $this->id_fiscal = "";
    }

    public function render()
    {
        $this->clientes = Cliente::with('persona')->get();
        return view('livewire.gestion-clientes');
    }
}
