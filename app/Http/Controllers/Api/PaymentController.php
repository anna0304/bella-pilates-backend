<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['user', 'plan'])
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $payments,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,card,bizum,bank_transfer',
            'status' => 'required|in:pending,paid,failed,refunded',
            'transaction_id' => 'nullable|string|max:255',
            'starts_at' => 'required|date',
            'expires_at' => 'required|date|after_or_equal:starts_at',
        ]);

        $payment = Payment::create($validated);
        $payment->load(['user', 'plan']);

        return response()->json([
            'status' => 'success',
            'message' => 'Pago creado correctamente',
            'data' => $payment,
        ], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pago no encontrado',
            ], 404);
        }

        $payment->update([
            'status' => $validated['status'],
        ]);

        $payment->load(['user', 'plan']);

        return response()->json([
            'status' => 'success',
            'message' => 'Estado del pago actualizado correctamente',
            'data' => $payment,
        ]);
    }
}