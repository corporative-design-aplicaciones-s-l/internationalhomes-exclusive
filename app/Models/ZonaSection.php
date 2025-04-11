<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZonaSection extends Model
{
    protected $fillable = ['zona_id', 'titulo', 'imagen', 'descripcion'];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
}
