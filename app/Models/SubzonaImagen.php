<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubzonaImagen extends Model
{
    use HasFactory;

    protected $fillable = ['subzona_id', 'path'];

    public function subzona()
    {
        return $this->belongsTo(Subzona::class);
    }
}
