<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaboracion extends Model
{
    protected $table = 'colaboraciones';
    protected $primaryKey = 'idColaboracion';
    public $timestamps = false;
    use HasFactory;

    public function calificaciones()
    {
        return $this->hasMany('App\Models\Calificacion','idColaboracion','idColaboracion');
    }
    public function necesidad()
    {
        return $this->belongsTo('App\Models\Necesidad','idNecesidad','idNecesidad');
    }

    public static function getColaboracion($idColaboracion)
    {
        return Colaboracion::where('idColaboracion',$idColaboracion)->first();

    }
    public static function noConcretarColaboraciones($idUsuario)
    {
        return Colaboracion::where('idColaborador',$idUsuario)
                            ->where('estadoColaboracion', 0)
                            ->update(['estadoColaboracion'=>'2']);
    }

}
