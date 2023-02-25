<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticasJugador extends Model
{
    use HasFactory;
    protected $fillable = [
        'goles',
        'remates',
        'asistencias',
        'torneo_id',
        'sanciones_id'
    ];

    public function torneo (){
        return $this->belongsTo(Torneos::class);
    }
    public function sancion (){
        return $this->belongsToMany(Sanciones::class);
    }
}
