<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'imagen_principal',
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function secciones()
    {
        return $this->hasMany(ZonaSection::class);
    }
}

