<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_partido',
        'equipo_id_local',
        'equipo_id_visitante',
    ];
    public function equipo (){
        return $this->belongsTo(Team::class);
    }
}
