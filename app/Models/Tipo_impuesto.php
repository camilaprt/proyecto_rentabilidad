<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo_impuesto extends Model
{
    protected $fillable = [
        'tipo_IVA',
    ];

    //One to many relationship with Factura
    public function facturas(){
        return $this->hasMany(Factura::class);
    }
}
