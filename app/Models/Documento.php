<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documento extends Model
{
    protected $casts=[
        'aspirante_id'=>'integer',
        'periodo'=>'string',
        'foto'=>'string',
        'certificado_prepa'=>'string',
        'constancia_terminacion'=>'string',
        'acta_nacimiento'=>'string',
        'curp'=>'string',
        'constancia_imss'=>'string',
        'created_at'=>'date:Y-m-d H:i:s',
        'updated_at'=>'date:Y-m-d H:i:s',
    ];

    protected $fillable=[
        'aspirante_id',
        'periodo',
        'foto',
        'certificado_prepa',
        'constancia_terminacion',
        'acta_nacimiento',
        'curp',
        'constancia_imss',
        'forma_migratoria'
    ];

    public function aspirante(): BelongsTo
    {
        return $this->belongsTo(Ficha::class, 'id');
    }
}
