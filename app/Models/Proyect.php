<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyect extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fechainicio',
        'estado',
        'responsable',
        'monto',
        'created_by'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fechainicio' => 'datetime',
        ];
    }

    // Relación con el modelo User (quien creó el proyecto)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
