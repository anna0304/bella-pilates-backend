<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $message = Message::create([
            ...$validated,
            'status' => 'unread',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Mensaje enviado correctamente',
            'data' => $message,
        ], 201);
    }

    public function index()
    {
        $messages = Message::orderByRaw("FIELD(status, 'unread', 'read', 'archived')")
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $messages,
        ]);
    }

    public function markAsRead($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mensaje no encontrado',
            ], 404);
        }

        $message->update([
            'status' => 'read',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Mensaje marcado como leído',
            'data' => $message,
        ]);
    }

    public function markAsUnread($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mensaje no encontrado',
            ], 404);
        }

        $message->update([
            'status' => 'unread',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Mensaje marcado como no leído',
            'data' => $message,
        ]);
    }

    public function archive($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mensaje no encontrado',
            ], 404);
        }

        $message->update([
            'status' => 'archived',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Mensaje archivado correctamente',
            'data' => $message,
        ]);
    }

    public function unarchive($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mensaje no encontrado',
            ], 404);
        }

        $message->update([
            'status' => 'read',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Mensaje restaurado correctamente',
            'data' => $message,
        ]);
    }
}
