<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //One to many relationship with Comprobante
    public function comprobantes(){
        return $this->hasMany(Comprobante::class);
    }
}
