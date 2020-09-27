<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hojas_ruta extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'user_id',
    	'unidade_id',
    	'hoja_ruta',
        'fecha',
        'unidad_solicitante',
        'detalle',
        'observacion',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function unidad()
    {
        return $this->belongsTo('App\Unidade');
    }
}
