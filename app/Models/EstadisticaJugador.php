<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticaJugador extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = [
        'goles',
        'remates',
        'asistencias',
        'torneo_id',
        'sanciones_id'
    ];

    public function torneo (){
        return $this->belongsTo(Torneo::class);
    }
    public function sancion (){
        return $this->belongsToMany(Sancion::class);
    }
}
