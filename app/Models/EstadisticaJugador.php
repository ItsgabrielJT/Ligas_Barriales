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
        'calendario_id',
        'sanciones_id',
        'jugador_id'
    ];

    public function calendario (){
        return $this->belongsTo(Calendaro::class);
    }

    public function sancion (){
        return $this->belongsToMany(Sancion::class);
    }

    public function jugador (){
        return $this->belongsToMany(User::class);
    }

}
