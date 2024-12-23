<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParametroFicha extends Model
{
    protected $connection = 'bdtec';
    protected $table = 'parametros_fichas';
    protected $primaryKey = 'id';
    protected $casts=[
        'fichas'=>'string',
        'activo'=>'boolean',
        'inicio_prope'=>'date',
        'fin_prope'=>'date',
        'entrega'=>'date',
        'termina'=>'date',
    ];
}
