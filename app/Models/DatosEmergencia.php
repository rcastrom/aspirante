<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatosEmergencia extends Model
{
    protected $fillable=['tipo_sangre_id','comunicar_con','tipo_alergia',
        'enfermedad','calle_numero','colonia','municipio','telefono_contacto',
        'lugar_trabajo','telefono_trabajo'];

    protected $casts=[
        'aspirante_id'=>'integer',
        'tipo_sangre_id'=>'integer',
        'comunicar_con'=>'string',
        'tipo_alergia'=>'string',
        'enfermedad'=>'string',
        'calle_numero'=>'string',
        'colonia'=>'string',
        'municipio'=>'string',
        'telefono'=>'string',
        'lugar_trabajo'=>'string',
        'telefono_trabajo'=>'string',
    ];

    public function aspirante(): BelongsTo
    {
        return $this->belongsTo(Ficha::class, 'id');
    }
    public function tipo_sangre(): BelongsTo{
        return $this->belongsTo(TiposSangre::class, 'tipo_sangre_id');
    }
}
