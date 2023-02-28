<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_partido',
        'local_id',
        'visitante_id',
    ];

    public function equipo (){
        return $this->belongsTo(Team::class);
    }
}
