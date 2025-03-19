<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    //One to one relationship with Categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    //One to one relationship with Proyecto
    public function proyecto(){
        return $this->belongsTo(Proyecto::class);
    }

    //One to one relationship with Proveedore
    public function proveedore(){
        return $this->belongsTo(Proveedore::class);
    }

    //One to one relationship with Cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    
}
