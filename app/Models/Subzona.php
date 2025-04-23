<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subzona extends Model
{
    protected $fillable = [
        'zona_id',
        'nombre',
        'slug',
        'contenido_html',
        'fecha_entrega',
        'ventajas',
        'equipamiento',
        'plano',
        'pdf_info_comercial',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function imagenes()
    {
        return $this->hasMany(SubzonaImagen::class);
    }
}
