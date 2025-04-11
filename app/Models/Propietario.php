<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'telefono', 'email', 'notas'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}

