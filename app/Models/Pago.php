<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'monto', 'fecha_pago', 'metodo', 'gestor',
    ];

    // Relación con el modelo User
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
