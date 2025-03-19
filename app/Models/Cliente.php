<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'persona_id',
    ];

    //One to one relationship with Persona
    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    //One to many relationship with Proyecto
    public function proyectos(){
        return $this->hasMany(Proyecto::class);
    }

    //One to many relationship with Comprobante
    public function comprobantes(){
        return $this->hasMany(Comprobante::class);
    }


}
