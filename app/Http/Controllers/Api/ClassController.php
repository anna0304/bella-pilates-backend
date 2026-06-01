<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClassController extends Controller
{
    public function index(): JsonResponse
    {
        $classes = ClassModel::where('is_active', true)
            ->orderByDesc('created_at')
            ->get()
            ->map(fn($class) => $this->formatClass($class));
        return response()->json([
            'status' => 'success',
            'data' => $classes,
        ]);
    }

    public function adminIndex(): JsonResponse
    {
        $classes = ClassModel::orderByDesc('created_at')
            ->get()
            ->map(fn($class) => $this->formatClass($class));

        return response()->json([
            'status' => 'success',
            'data' => $classes,
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $class = ClassModel::with([
            'schedules' => function ($query) {
                $query->where('is_active', true);
            },
            'recordedClasses' => function ($query) {
                $query->where('is_active', true);
            },
        ])
            ->where('is_active', true)
            ->find($id);

        if (!$class) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clase no encontrada',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $this->formatClass($class),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'level' => ['required', 'string', 'max:50'],
            'duration' => ['required', 'integer', 'min:10'],
            'max_capacity' => ['required', 'integer', 'min:1'],
            'instructor_name' => ['required', 'string', 'max:150'],
            'image' => ['nullable', 'image', 'max:10240'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('classes', 'public');
        }

        $class = ClassModel::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Clase creada correctamente',
            'data' => $this->formatClass($class),
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $class = ClassModel::find($id);

        if (!$class) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clase no encontrada',
            ], 404);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:150'],
            'description' => ['sometimes', 'nullable', 'string'],
            'category' => ['sometimes', 'required', 'string', 'max:100'],
            'level' => ['sometimes', 'required', 'string', 'max:50'],
            'duration' => ['sometimes', 'required', 'integer', 'min:10'],
            'max_capacity' => ['sometimes', 'required', 'integer', 'min:1'],
            'instructor_name' => ['sometimes', 'required', 'string', 'max:150'],
            'image' => ['sometimes', 'nullable', 'image', 'max:10240'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($class->image) {
                Storage::disk('public')->delete($class->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('classes', 'public');
        }

        $class->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Clase actualizada correctamente',
            'data' => $this->formatClass($class),
        ]);
    }

    public function deactivate($id): JsonResponse
    {
        $class = ClassModel::find($id);

        if (!$class) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clase no encontrada',
            ], 404);
        }

        $class->update([
            'is_active' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Clase desactivada correctamente',
            'data' => $this->formatClass($class),
        ]);
    }

    public function activate($id): JsonResponse
    {
        $class = ClassModel::find($id);

        if (!$class) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clase no encontrada',
            ], 404);
        }

        $class->update([
            'is_active' => true,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Clase activada correctamente',
            'data' => $this->formatClass($class),
        ]);
    }

    private function formatClass(ClassModel $class): array
    {
        $data = $class->toArray();

        if ($class->image && ! str_starts_with($class->image, 'http')) {
            $data['image'] = asset('storage/' . $class->image);
        }

        return $data;
    }
}
