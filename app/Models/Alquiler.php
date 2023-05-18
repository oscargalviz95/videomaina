<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fechaAlquiler',
        'fechaDevolucion',
        'pelicula_id',
        'sucursal_id',
        'user_id'
    ];
    protected $table = "alquileres";


    //Relaciónes uno a muchos inversas
    public function sucursal(){
        
        return $this->belongsTo(Sucursal::class,'sucursal_id');

    }

    public function pelicula(){
        
        return $this->belongsTo(Pelicula::class,'pelicula_id');

    }

    public function usuario(){
        
        return $this->belongsTo(User::class,'user_id');

    }

}
