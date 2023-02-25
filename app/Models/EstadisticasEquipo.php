<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticasEquipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_disparos',
        'asisitencias',
        'faltas',
        'tiros_esquina',
        'pases',
        'tiros_fallidos',
        'torneo_id'
    ];

    public function torneo (){
        return $this->belongsTo(Torneos::class);
    }
}
