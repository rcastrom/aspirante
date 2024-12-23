<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatosSocioeconomico extends Model
{
    protected $fillable=['nivel_estudios_padre_id','nivel_estudios_madre_id',
        'habita','ingresos_padre','ingresos_madre','ingresos_hermanos',
        'ingresos_propios','ocupacion_padre_id','ocupacion_madre_id',
        'casa_vives','dependencia','cuartos_casa','personas_casa','personas_dependen'];

    protected $casts=[
        'nivel_estudios_padre_id'=>'integer',
        'nivel_estudios_madre_id'=>'integer',
        'habita'=>'string',
        'ingresos_padre'=>'integer',
        'ingresos_madre'=>'integer',
        'ingresos_hermanos'=>'integer',
        'ingresos_propios'=>'integer',
        'ocupacion_padre_id'=>'integer',
        'ocupacion_madre_id'=>'integer',
        'dependencia'=>'string',
        'cuartos_casa'=>'integer',
        'personas_casa'=>'integer',
        'personas_dependen'=>'integer',
    ];

    public function aspirante(): BelongsTo
    {
        return $this->belongsTo(Ficha::class, 'id');
    }
    public function nivelEstudioPadre(): BelongsTo
    {
        return $this->belongsTo(NivelEstudio::class, 'nivel_estudios_padre_id');
    }
    public function nivelEstudioMadre(): BelongsTo
    {
        return $this->belongsTo(NivelEstudio::class, 'nivel_estudios_madre_id');
    }
    public function ocupacionPadre(): BelongsTo
    {
        return $this->belongsTo(Ocupacion::class, 'ocupacion_padre_id');
    }
    public function ocupacionMadre(): BelongsTo
    {
        return $this->belongsTo(Ocupacion::class, 'ocupacion_madre_id');
    }
}
