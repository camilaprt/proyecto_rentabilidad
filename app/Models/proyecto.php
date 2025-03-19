<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //One to many relationship with Comprobante
    public function comprobantes(){
        return $this->hasMany(Comprobante::class);
    }

    //One to one relationship with Cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
   
}
