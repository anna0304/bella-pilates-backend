<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function myReservations(Request $request)
    {
        $reservations = Reservation::with(['schedule.class'])
            ->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $reservations,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'notes' => 'nullable|string|max:500',
        ]);

        $schedule = Schedule::where('id', $validated['schedule_id'])
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return response()->json([
                'status' => 'error',
                'message' => 'El horario no está disponible',
            ], 404);
        }

        $alreadyReserved = Reservation::where('user_id', $request->user()->id)
            ->where('schedule_id', $validated['schedule_id'])
            ->whereIn('status', ['confirmed'])
            ->exists();

        if ($alreadyReserved) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ya tienes una reserva activa para este horario',
            ], 409);
        }

        $reservation = Reservation::create([
            'user_id' => $request->user()->id,
            'schedule_id' => $validated['schedule_id'],
            'status' => 'confirmed',
            'notes' => $validated['notes'] ?? null,
        ]);

        $reservation->load(['schedule.class']);

        return response()->json([
            'status' => 'success',
            'message' => 'Reserva creada correctamente',
            'data' => $reservation,
        ], 201);
    }

    public function cancel(Request $request, $id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$reservation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Reserva no encontrada',
            ], 404);
        }

        if ($reservation->status === 'cancelled') {
            return response()->json([
                'status' => 'error',
                'message' => 'La reserva ya está cancelada',
            ], 409);
        }

        $reservation->update([
            'status' => 'cancelled',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Reserva cancelada correctamente',
            'data' => $reservation,
        ]);
    }

    public function index()
    {
        $reservations = Reservation::with(['user', 'schedule.class'])
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $reservations,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:confirmed,completed,cancelled',
        ]);

        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Reserva no encontrada',
            ], 404);
        }

        $reservation->update([
            'status' => $validated['status'],
        ]);

        $reservation->load(['user', 'schedule.class']);

        return response()->json([
            'status' => 'success',
            'message' => 'Estado de la reserva actualizado correctamente',
            'data' => $reservation,
        ]);
    }
}