<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //One to one relation with cliente
    public function cliente(){
        return $this->hasOne(Cliente::class);
    }

    //One to one relation with proveedor
    public function proveedor(){
        return $this->hasOne(Proveedore::class);
    }
}
