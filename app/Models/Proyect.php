<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyect extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'user_id_create',
        'user_id_last_update',
        'activo',
    ];

    // Relación con el modelo User (quien creó el proyecto)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
