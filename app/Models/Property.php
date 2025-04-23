<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref',
        'title',
        'location',
        'price',
        'tipo',
        'is_featured',
        'description',
        'description_en',
        'description_fr',
        'description_de',
        'description_ru',
        'thumbnail',
        'subzona_id',
        'propietario_id',
        'bathrooms',
        'bedrooms',
        'area',
        'tiene_solar',
        'metros_solar',
        'tiene_patio',
        'tiene_piscina',
    ];

    public function subzona()
    {
        return $this->belongsTo(Subzona::class);
    }

    // public function zona(): HasOneThrough
    // {
    //     return $this->hasOneThrough(
    //         \App\Models\Zona::class,
    //         \App\Models\Subzona::class,
    //         'id',          // Foreign key on subzonas table
    //         'id',          // Foreign key on zonas table
    //         'subzona_id',  // Local key on properties table
    //         'zona_id'      // Local key on subzonas table
    //     );
    // }

    public function getZonaAttribute()
{
    return $this->subzona?->zona;
}

    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }

    public function contactos()
    {
        return $this->hasMany(Contacto::class);
    }

    protected static function booted()
    {
        static::created(function ($property) {
            $property->update(['ref' => "R-{$property->id}"]);
        });

        static::creating(function ($property) {
            $baseSlug = Str::slug($property->title);
            $slug = $baseSlug;
            $count = 2;

            // Verifica unicidad
            while (Property::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            $property->slug = $slug;

            // Ref automática si no se ha generado aún
            if (empty($property->ref)) {
                $property->ref = "R-{$property->id}";
            }
        });
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}
