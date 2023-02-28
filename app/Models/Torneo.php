<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'titulo',
        'trofeo_image',
        'estado_torneo',
        'calendario_id',
    ];

    public function calendario (){
        return $this->belongsTo(Calendario::class);
    }
}
