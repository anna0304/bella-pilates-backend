<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RecordedClass;
use Illuminate\Http\Request;

class RecordedClassController extends Controller
{
    public function index()
    {
        $recordedClasses = RecordedClass::with('class')
            ->where('is_active', true)
            ->orderByDesc('featured')
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $recordedClasses,
        ]);
    }

    public function show($id)
    {
        $recordedClass = RecordedClass::with('class')
            ->where('is_active', true)
            ->find($id);

        if (!$recordedClass) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clase grabada no encontrada',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $recordedClass,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url|max:500',
            'thumbnail' => 'nullable|string|max:500',
            'duration' => 'required|integer|min:1',
            'level' => 'required|string|max:50',
            'featured' => 'sometimes|boolean',
        ]);

        $recordedClass = RecordedClass::create($validated);

        $recordedClass->load('class');

        return response()->json([
            'status' => 'success',
            'message' => 'Clase grabada creada correctamente',
            'data' => $recordedClass,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $recordedClass = RecordedClass::find($id);

        if (!$recordedClass) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clase grabada no encontrada',
            ], 404);
        }

        $validated = $request->validate([
            'class_id' => 'sometimes|required|exists:classes,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'video_url' => 'sometimes|required|url|max:500',
            'thumbnail' => 'sometimes|nullable|string|max:500',
            'duration' => 'sometimes|required|integer|min:1',
            'level' => 'sometimes|required|string|max:50',
            'featured' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
        ]);

        $recordedClass->update($validated);

        $recordedClass->load('class');

        return response()->json([
            'status' => 'success',
            'message' => 'Clase grabada actualizada correctamente',
            'data' => $recordedClass,
        ]);
    }

    public function deactivate($id)
    {
        $recordedClass = RecordedClass::find($id);

        if (!$recordedClass) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clase grabada no encontrada',
            ], 404);
        }

        $recordedClass->update([
            'is_active' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Clase grabada desactivada correctamente',
        ]);
    }
}