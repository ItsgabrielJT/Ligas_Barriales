<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanciones extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo'
    ];
    public function estadisticaJugador (){
        return $this->belongsToMany(EstadisticasJugador::class);
    }
}
