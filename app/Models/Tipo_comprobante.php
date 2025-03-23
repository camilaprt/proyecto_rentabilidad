<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo_comprobante extends Model
{
    protected $fillable = [
        'tipo',
    ];


    //One to many relationship with Comprobante
    public function comprobantes(){
        return $this->hasMany(Comprobante::class);
    }
}
