<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('price')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $plans,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'classes_per_month' => 'required|integer|min:1',
            'duration_days' => 'required|integer|min:1',
            'is_featured' => 'sometimes|boolean',
        ]);

        $plan = Plan::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Plan creado correctamente',
            'data' => $plan,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Plan no encontrado',
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'classes_per_month' => 'sometimes|required|integer|min:1',
            'duration_days' => 'sometimes|required|integer|min:1',
            'is_featured' => 'sometimes|boolean',
            'is_active' => 'sometimes|boolean',
        ]);

        $plan->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Plan actualizado correctamente',
            'data' => $plan,
        ]);
    }

    public function deactivate($id)
    {
        $plan = Plan::find($id);

        if (!$plan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Plan no encontrado',
            ], 404);
        }

        $plan->update([
            'is_active' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Plan desactivado correctamente',
        ]);
    }
}