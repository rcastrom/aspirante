<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatoFamiliar extends Model
{
    protected $table='datos_familiares';
    protected $fillable=['vive_padre','apellido_paterno_padre','apellido_materno_padre',
        'nombre_padre','apellido_paterno_madre','apellido_materno_madre',
        'nombre_madre','vive_madre','estado_civil','capacidad_diferente',
        'beca','zona_procedencia'];
    protected $casts=[
        'vive_padre'=>'boolean',
        'vive_madre'=>'boolean',
        'apellido_paterno_padre'=>'string',
        'apellido_materno_padre'=>'string',
        'nombre_padre'=>'string',
        'apellido_paterno_madre'=>'string',
        'apellido_materno_madre'=>'string',
        'nombre_madre'=>'string',
        'estado_civil'=>'string',
        'capacidad_diferente'=>'string',
        'beca'=>'string',
        'zona_procedencia'=>'string',
    ];

    public function aspirante(): BelongsTo
    {
        return $this->belongsTo(Ficha::class,'id');
    }
}
