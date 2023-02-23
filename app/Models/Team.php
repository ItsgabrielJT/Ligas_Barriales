<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_equipo',
        'descripcion',
        'user_id',
        'plantilla_id',
    ];

    public function user (){
        return $this->belongsTo(User::class);
    }
    public function plantilla (){
        return $this->belongsTo(Plantilla::class);
    }
}
