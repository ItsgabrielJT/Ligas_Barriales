<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'nombre_equipo',
        'descripcion',
        'image',
        'user_id',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function plantilla () {
        return $this->belongsTo(Plantilla::class);
    }
}
