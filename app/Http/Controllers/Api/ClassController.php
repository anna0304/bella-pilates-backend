<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use Illuminate\Http\JsonResponse;

class ClassController extends Controller
{
    /**
     * Obtener todas las clases activas
     */
    public function index(): JsonResponse
    {
        $classes = ClassModel::where(
            'is_active',
            true
        )->get();

        return response()->json([
            'success' => true,
            'data' => $classes,
        ]);
    }

    /**
     * Obtener una clase específica con sus horarios
     */
    /**
     * Obtener una clase específica
     * con horarios y clases grabadas
     */
    public function show(int $id): JsonResponse
    {
        $class = ClassModel::with([
            'schedules' => function ($query) {
                $query->where('is_active', true);
            },

            'recordedClasses' => function ($query) {
                $query->where('is_active', true);
            }
        ])
            ->where('is_active', true)
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $class,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'in:reformer,mat,flow,yoga,stretching'],
            'level' => ['required', 'in:beginner,intermediate,advanced'],
            'duration' => ['required', 'integer', 'min:10'],
            'max_capacity' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $class = ClassModel::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Clase creada correctamente.',
            'data' => $class,
        ], 201);
    }

    public function update(Request $request, ClassModel $class): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'in:reformer,mat,flow,yoga,stretching'],
            'level' => ['required', 'in:beginner,intermediate,advanced'],
            'duration' => ['required', 'integer', 'min:10'],
            'max_capacity' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $class->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Clase actualizada correctamente.',
            'data' => $class,
        ]);
    }

    public function deactivate(ClassModel $class): JsonResponse
    {
        $class->update([
            'is_active' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Clase desactivada correctamente.',
            'data' => $class,
        ]);
    }
}
