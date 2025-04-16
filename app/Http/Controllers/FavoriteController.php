<?php
namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $id = $request->input('id');
        $favorites = json_decode($request->cookie('favorites', '[]'), true);

        if (!is_array($favorites)) {
            $favorites = [];
        }

        if (in_array($id, $favorites)) {
            $favorites = array_filter($favorites, fn($fav) => $fav != $id);
            $status = 'removed';
        } else {
            $favorites[] = $id;
            $status = 'added';
        }

        return response()->json([
            'status' => $status,
            'favorites' => $favorites
        ])->cookie('favorites', json_encode(array_values($favorites)), 60 * 24 * 30); // 30 días
    }
}
