<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'codigoInventario',
        'titulo',
        'formato',
        'precio',
        'cantidad'
    ];

    //Relaciones de uno a muchos
    public function alquiler(){

        return $this->hasMany(Alquiler::class);
    }
    
    public function multas(){

        return $this->hasMany(Multa::class);
    
    }
    
}
