<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo_factura extends Model
{
    protected $fillable = [
        'tipo',
    ];
    
    //One to many relationship with Factura
    public function facturas(){
        return $this->hasMany(Factura::class);
    }
}
