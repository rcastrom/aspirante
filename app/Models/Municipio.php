<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $casts=[
        'estado_id'=>'integer',
        'municipio'=>'string',
    ];
    public function estado(){
        return $this->belongsTo(Estado::class);
    }
}
