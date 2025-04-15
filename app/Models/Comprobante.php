<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    protected $fillable = [
        'numero_comprobante',
        'fecha',
        'cantidad',
        'descripcion',
        'categorias_id',
        'proyectos_id',
        'proveedores_id',
        'clientes_id',
        'tipo_comprobante_id',
    ];

    //One to one relationship with Tipo_comprobante
    public function tipo_comprobante()
    {
        return $this->belongsTo(Tipo_comprobante::class);
    }

    //One to one relationship with Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categorias_id');
    }

    //One to one relationship with Proyecto
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectos_id');
    }

    //One to one relationship with Proveedore
    public function proveedore()
    {
        return $this->belongsTo(Proveedore::class, 'proveedores_id');
    }

    //One to one relationship with Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clientes_id');
    }
}
