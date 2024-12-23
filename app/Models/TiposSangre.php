<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposSangre extends Model
{
    protected $table="tipos_sangre";
    protected $casts=[
        'tipo_sangre'=>'string'
    ];
}
