<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneos extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titulo',
        'descripcion',
        'estado_torneo',
        'calendario_id',
    ];
    public function calendario (){
        return $this->belongsTo(Calendario::class);
    }
}
