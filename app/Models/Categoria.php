<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
    ];

    //One to many relationship with Comprobante
    public function comprobantes()
    {
        return $this->hasMany(Comprobante::class, 'categorias_id');
    }
    //One to many relationship with Factura
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'categorias_id');
    }
}
