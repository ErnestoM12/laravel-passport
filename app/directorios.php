<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class directorios extends Model
{
    protected $table = 'directorios';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'foto',
        'userId'
    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
