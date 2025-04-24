<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class BotonAgregarCategoria extends Component
{
    public $categoria_id;
    public $categorias;

    public $nueva_categoria;
    public $modalCrear = false;

    //metodo de livewire que cambia cuando cambia la propiedad categoria_id
    public function abrirModalCrear()
    {
        $this->modalCrear = true;
    }

    public function cerrarModalCrear()
    {
        $this->modalCrear = false;
    }

    public function agregarCategoria()
    {
        $this->validate([
            'nueva_categoria' => 'required|string|max:45',
        ]);

        $categoria = Categoria::create([
            'nombre' => $this->nueva_categoria,
        ]);
        //Guardar id de nueva categoria que luego se pasara al padre
        $this->categoria_id = $categoria->id;
        //Resetear campos
        $this->nueva_categoria = '';
        $this->modalCrear = false;

        // Emitir al padre
        $this->dispatch('categoriaAgregada', $categoria->id);
    }

    public function render()
    {
        return view('livewire.boton-agregar-categoria');
    }
}
