<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    use HasFactory;

    protected $fillable = [
        'jugador_id',
        'equipo_id',
    ];

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function equipo (){
        return $this->belongsTo(Equipo::class);
    }
}
