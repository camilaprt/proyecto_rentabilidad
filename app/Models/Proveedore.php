<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    public function persona(){
        return $this->belongsTo(Persona::class);
    }
}
