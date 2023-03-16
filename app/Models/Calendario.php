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
        'torneo_id',
    ];

    public function local (){
        return $this->belongsTo(Equipo::class);
    }

    public function visitante (){
        return $this->belongsTo(Equipo::class);
    }
  
    public function torneo (){
        return $this->belongsTo(Torneo::class);
    }
    
}
