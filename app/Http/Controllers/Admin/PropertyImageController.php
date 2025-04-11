<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{
    public function destroy(PropertyImage $image)
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('success', 'Imagen eliminada correctamente.');
    }

    public function setThumbnail(Property $property, PropertyImage $image)
    {
        // Seguridad: asegúrate de que la imagen pertenece a la propiedad
        if ($image->property_id !== $property->id) {
            abort(403);
        }

        $property->thumbnail = $image->path;
        $property->save();

        return back()->with('success', 'Thumbnail actualizado.');
    }
}
