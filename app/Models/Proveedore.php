<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    protected $fillable = [
        'persona_id',
    ];

    //One to one relationship with Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    //One to many relationship with Comprobante
    public function comprobantes()
    {
        return $this->hasMany(Comprobante::class, 'proveedores_id');
    }

    //One to many relationship with Factura
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'proveedores_id');
    }
}
