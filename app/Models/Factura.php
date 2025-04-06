<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = [
        'numero_fra',
        'fecha',
        'descripcion',
        'base_imp',
        'total',
        'tipo_factura_id',
        'tipo_impuesto_id',
        'categorias_id',
        'proyectos_id',
        'proveedores_id',
        'clientes_id',
    ];

    //One to one relationship with Tipo_factura
    public function tipo_factura(){
        return $this->belongsTo(Tipo_factura::class);
    }
    //One to one relationship with Tipo_impuesto
    public function tipo_impuesto(){
        return $this->belongsTo(Tipo_impuesto::class);
    }

    //One to one relationship with Categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class,'categorias_id');
    }

    //One to one relationship with Proyecto
    public function proyecto(){
        return $this->belongsTo(Proyecto::class,'proyectos_id');
    }

    //One to one relationship with Proveedore
    public function proveedore(){
        return $this->belongsTo(Proveedore::class, 'proveedores_id');
    }

    //One to one relationship with Cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class,'clientes_id');
    }
}
