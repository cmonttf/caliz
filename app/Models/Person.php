<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    protected $fillable = ['nombres','apellidos','direccion','telefono','correo','monto','medio_de_pago'];

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'user_id');
    }
}
