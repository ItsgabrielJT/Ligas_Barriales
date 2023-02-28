<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadisticaEquipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_disparos',
        'asisitencias',
        'faltas',
        'tiros_esquina',
        'pases',
        'tiros_fallidos',
        'calendario_id',
    ];

    public function calendario (){
        return $this->belongsTo(Calendario::class);
    }
    
}
