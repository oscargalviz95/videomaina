<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'direccion',
        'telefono',
        'nombreAdministrador',
        'cedulaAdministrador'
    ];

    //Relaciones de uno a muchos
    public function alquiler(){

        return $this->hasMany(Alquiler::class);
    }

}
