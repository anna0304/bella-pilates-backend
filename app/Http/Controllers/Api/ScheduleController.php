<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::with('class')
            ->withCount([
                'reservations as reservations_count' => function ($query) {
                    $query->where('status', 'confirmed');
                },
            ]);

        if (!$request->user() || $request->user()->role !== 'admin') {
            $query->where('is_active', true);
        }

        $schedules = $query
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $schedules,
        ]);
    }

    public function show($id)
    {
        $schedule = Schedule::with('class')
            ->withCount([
                'reservations as reservations_count' => function ($query) {
                    $query->where('status', 'confirmed');
                },
            ])
            ->where('is_active', true)
            ->find($id);

        if (!$schedule) {
            return response()->json([
                'status' => 'error',
                'message' => 'Horario no encontrado',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $schedule,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'day_of_week' => 'required|string|max:20',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'instructor_name' => 'required|string|max:255',
            'room' => 'nullable|string|max:255',
        ]);

        $schedule = Schedule::create($validated);
        $schedule->load('class');
        $schedule->loadCount([
            'reservations as reservations_count' => function ($query) {
                $query->where('status', 'confirmed');
            },
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Horario creado correctamente',
            'data' => $schedule,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json([
                'status' => 'error',
                'message' => 'Horario no encontrado',
            ], 404);
        }

        $validated = $request->validate([
            'class_id' => 'sometimes|required|exists:classes,id',
            'day_of_week' => 'sometimes|required|string|max:20',
            'start_time' => 'sometimes|required|date_format:H:i',
            'end_time' => 'sometimes|required|date_format:H:i|after:start_time',
            'instructor_name' => 'sometimes|required|string|max:255',
            'room' => 'sometimes|nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        $schedule->update($validated);

        $schedule->load('class');
        $schedule->loadCount([
            'reservations as reservations_count' => function ($query) {
                $query->where('status', 'confirmed');
            },
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Horario actualizado correctamente',
            'data' => $schedule,
        ]);
    }

    public function deactivate($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json([
                'status' => 'error',
                'message' => 'Horario no encontrado',
            ], 404);
        }

        $schedule->update([
            'is_active' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Horario desactivado correctamente',
        ]);
    }
}