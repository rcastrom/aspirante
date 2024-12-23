<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $casts=[
        'id_estado'=>'integer',
        'estado'=>'string',
        'abreviatura'=>'string',
    ];

}
