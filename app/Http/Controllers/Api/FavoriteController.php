<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\RecordedClass;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = Favorite::with(['recordedClass.class'])
            ->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $favorites,
        ]);
    }

    public function store(Request $request, $recordedClass)
    {
        $recordedClassExists = RecordedClass::where('id', $recordedClass)
            ->where('is_active', true)
            ->exists();

        if (!$recordedClassExists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clase grabada no encontrada o inactiva',
            ], 404);
        }

        $favorite = Favorite::firstOrCreate([
            'user_id' => $request->user()->id,
            'recorded_class_id' => $recordedClass,
        ]);

        $favorite->load(['recordedClass.class']);

        return response()->json([
            'status' => 'success',
            'message' => 'Clase agregada a favoritos correctamente',
            'data' => $favorite,
        ], 201);
    }

    public function destroy(Request $request, $recordedClass)
    {
        $favorite = Favorite::where('user_id', $request->user()->id)
            ->where('recorded_class_id', $recordedClass)
            ->first();

        if (!$favorite) {
            return response()->json([
                'status' => 'error',
                'message' => 'Favorito no encontrado',
            ], 404);
        }

        $favorite->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Clase eliminada de favoritos correctamente',
        ]);
    }
}