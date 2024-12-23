<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatoPreparatoria extends Model
{
    protected $table = 'datos_preparatoria';

    protected $fillable=['estado_id','nombre_preparatoria','egreso','promedio'];
    protected $casts=[
        'aspirante_id'=>'integer',
        'estado_id'=>'integer',
        'nombre_preparatoria'=>'string',
        'egreso'=>'string',
        'promedio'=>'string',
    ];

    public function aspirante(): BelongsTo
    {
        return $this->belongsTo(Ficha::class, 'id');
    }
    public function estado(): BelongsTo{
        return $this->belongsTo(Estado::class, 'estado_id','estado_id');
    }
}
