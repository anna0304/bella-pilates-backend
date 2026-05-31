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

        $schedule = Schedule::with('class')
            ->where('id', $validated['schedule_id'])
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
            ->where('status', 'confirmed')
            ->exists();

        if ($alreadyReserved) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ya tienes una reserva activa para este horario',
            ], 409);
        }

        if (!$this->scheduleHasCapacity($schedule)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay plazas disponibles para este horario',
            ], 409);
        }

        $reservation = Reservation::create([
            'user_id' => $request->user()->id,
            'schedule_id' => $validated['schedule_id'],
            'status' => 'confirmed',
            'notes' => $validated['notes'] ?? null,
        ]);

        $reservation->load(['user', 'schedule.class']);

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

        $reservation->load(['user', 'schedule.class']);

        return response()->json([
            'status' => 'success',
            'message' => 'Reserva cancelada correctamente',
            'data' => $reservation,
        ]);
    }

    public function index()
    {
        $reservations = Reservation::with([
            'user',
            'schedule.class',
        ])
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $reservations,
        ]);
    }

    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'notes' => 'nullable|string|max:500',
        ]);

        $schedule = Schedule::with('class')
            ->where('id', $validated['schedule_id'])
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return response()->json([
                'status' => 'error',
                'message' => 'El horario no está disponible',
            ], 404);
        }

        $alreadyReserved = Reservation::where('user_id', $validated['user_id'])
            ->where('schedule_id', $validated['schedule_id'])
            ->where('status', 'confirmed')
            ->exists();

        if ($alreadyReserved) {
            return response()->json([
                'status' => 'error',
                'message' => 'Este usuario ya tiene una reserva activa para este horario',
            ], 409);
        }

        if (!$this->scheduleHasCapacity($schedule)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay plazas disponibles para este horario',
            ], 409);
        }

        $reservation = Reservation::create([
            'user_id' => $validated['user_id'],
            'schedule_id' => $validated['schedule_id'],
            'status' => 'confirmed',
            'notes' => $validated['notes'] ?? null,
        ]);

        $reservation->load(['user', 'schedule.class']);

        return response()->json([
            'status' => 'success',
            'message' => 'Reserva creada correctamente',
            'data' => $reservation,
        ], 201);
    }

    public function availableSchedules()
    {
        $schedules = Schedule::with('class')
            ->withCount([
                'reservations as active_reservations_count' => function ($query) {
                    $query->where('status', 'confirmed');
                },
            ])
            ->where('is_active', true)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->filter(function ($schedule) {
                $capacity = $schedule->class?->max_capacity ?? 0;

                return $capacity > 0 &&
                    $schedule->active_reservations_count < $capacity;
            })
            ->values();

        return response()->json([
            'status' => 'success',
            'data' => $schedules,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed,no_show',
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

    private function scheduleHasCapacity(Schedule $schedule): bool
    {
        $capacity = $schedule->class?->max_capacity ?? 0;

        if ($capacity <= 0) {
            return false;
        }

        $activeReservationsCount = Reservation::where('schedule_id', $schedule->id)
            ->where('status', 'confirmed')
            ->count();

        return $activeReservationsCount < $capacity;
    }
}