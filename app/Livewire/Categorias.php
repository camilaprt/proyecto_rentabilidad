<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categoria;

class Categorias extends Component
{
    public $categorias;
    public $categoria_id;
    public $categoria_actual;

    public $nombre_categoria;
    public $modalCrear = false;
    public $modalEditar = false;


    public function abrirModalCrear()
    {
        $this->modalCrear = true;
    }

    public function cerrarModalCrear()
    {
        $this->modalCrear = false;
    }

    public function abrirModalEditar($id)
    {
        $this->categoria_actual = Categoria::findOrFail($id);
        $this->categoria_id = $id;
        $this->nombre_categoria = $this->categoria_actual->nombre;
        $this->modalEditar = true;
    }
    public function cerrarModalEditar()
    {
        $this->modalEditar = false;
        $this->resetErrorBag(); //limpia mensajes de error
        $this->resetValidation(); // limpia errores de validación personalizados
        $this->reset(); //limpia los campos
    }

    public function eliminarCategoria($id)
    {
        $this->categoria_id = $id;
        //comprobar que categoria no tiene asociados comprobantes
        $categoria = Categoria::withCount(['comprobantes', 'facturas'])->findOrFail($this->categoria_id);
        if ($categoria->comprobantes_count > 0 || $categoria->facturas_count > 0) {
            return redirect()->to('/categorias')->with('exists', 'la categoria no se puede eliminar porque tiene comprobantes asociados');
        }
        try {
            $categoria = Categoria::findOrFail($this->categoria_id);
            $categoria->delete();

            //Mensaje flash
            return redirect()->to('/categorias')->with('success', 'Categoria eliminada');
        } catch (\Exception $e) {
            return redirect()->to('/clientes')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function actualizarCategoria()
    {
        $this->validate([
            'nombre_categoria' => 'required|string|max:45',
        ]);

        try {
            $this->categoria_actual->nombre = $this->nombre_categoria;
            $this->categoria_actual->save();
            //Mensaje flash
            return redirect()->to('/categorias')->with('success', 'Categoria actualizada');
        } catch (\Exception $e) {
            return redirect()->to('/categorias')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function crearCategoria()
    {
        $this->validate([
            'nombre_categoria' => 'required|string|max:45',
        ]);

        try {
            Categoria::create([
                'nombre' => $this->nombre_categoria,
            ]);
            return redirect()->to('/categorias')->with('success', 'Categoria creada');
        } catch (\Exception $e) {
            return redirect()->to('/categorias')->with('error', 'Error' . $e->getMessage());
        }
    }

    public function render()
    {
        $this->categorias = Categoria::all();
        return view('livewire.categorias');
    }
}
