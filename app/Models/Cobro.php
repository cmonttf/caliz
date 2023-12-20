<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Person;

class Cobro extends Model
{
    use HasFactory;

    protected $fillable = [
        'mes', 'anio', 'monto', 'pagado', 'user_id',
    ];

    // Relación con el modelo User
    public function cobro()
    {
        return $this->belongsTo(Cobro::class);
    }

    public function persona(){
        return $this->belongsTo('App\Models\Person', 'user_id');
    }


}
