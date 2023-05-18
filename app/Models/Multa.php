<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fechaMulta',
        'valor',
        'saldo',
        'pelicula_id',
        'user_id'
    ];

    public function pelicula(){

        return $this->belongsTo(Pelicula::class,'pelicula_id');
    
    }

    public function usuario(){

        return $this->belongsTo(User::class,'user_id');
    
    }
}
