<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    public mixed $periodo;
    /**
     * @var int|mixed
     */
    public mixed $aspirante;
    protected $casts=[
        'periodo'=>'string',
        'aspirante'=>'integer',
        'bandera1'=>'integer',
        'bandera2'=>'integer',
        'bandera3'=>'integer',
        'bandera4'=>'integer',
        'control'=>'string',
    ];
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
