<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table='paises';
    protected $casts=[
        'nombre'=>'string',
        'codigo'=>'string',
        'continente'=>'string'
    ];
}
