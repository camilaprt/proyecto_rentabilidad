<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'clientes_id',
    ];

    //One to many relationship with Comprobante
    public function comprobantes(){
        return $this->hasMany(Comprobante::class);
    }

    //One to many relationship with Factura
    public function facturas(){
        return $this->hasMany(Factura::class);
    }

    //One to one relationship with Cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class,'clientes_id');
    }
   
}
