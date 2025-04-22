<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subzona extends Model
{
    protected $fillable = ['zona_id', 'nombre', 'slug', 'contenido_html'];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function propiedades()
    {
        return $this->hasMany(Property::class);
    }

    public function imagenes()
    {
        return $this->hasMany(SubzonaImagen::class);
    }
}
