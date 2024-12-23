<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatoPersonal extends Model
{

    protected $table='datos_personales';
    protected $casts=[
        'nombre'=>'string',
        'apellido_paterno'=>'string',
        'apellido_materno'=>'string',
        'fecha_nacimiento'=>'date',
        'curp'=>'string',
        'carrera'=>'string',
        'telefono'=>'string',
        'calle_numero'=>'string',
    ];
    protected $fillable=['nombre','apellido_paterno','apellido_materno','fecha_nacimiento',
        'sexo','pais_id','estado_nacimiento_id','municipio_nacimiento_id','etnia_id','curp',
        'calle_numero','colonia','telefono','estado_domicilio_id',
        'municipio_domicilio_id','codigo_postal'];

    public function aspirante(): BelongsTo
    {
        return $this->belongsTo(Ficha::class, 'id');
    }
    public function pais(): BelongsTo
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }
    public function estado_nacimiento(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_nacimiento_id','estado_id');
    }
    public function municipio_nacimiento(): BelongsTo
    {
        return $this->belongsTo(Municipio::class,'municipio_nacimiento_id');
    }
    public function etnia(): BelongsTo
    {
        return $this->belongsTo(Etnia::class,'etnia_id');
    }
    public function estado_domicilio(): BelongsTo
    {
        return $this->belongsTo(Estado::class,'estado_domicilio_id','estado_id');
    }
    public function municipio_domicilio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class,'municipio_domicilio_id');
    }
}
