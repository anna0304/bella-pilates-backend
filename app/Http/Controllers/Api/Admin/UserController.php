<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', Rule::in(['admin', 'user', 'instructor'])],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $temporaryPassword = Str::password(10);

        $user = User::create([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($temporaryPassword),
            'role' => $validated['role'],
            'status' => $validated['status'],
            'must_change_password' => true,
        ]);

        return response()->json([
            'message' => 'Usuario creado correctamente.',
            'temporary_password' => $temporaryPassword,
            'user' => $user,
        ], 201);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', Rule::in(['admin', 'user', 'instructor'])],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Usuario actualizado correctamente.',
            'user' => $user,
        ]);
    }

    public function index()
    {
        $users = User::select(
            'id',
            'name',
            'surname',
            'email',
            'phone',
            'role',
            'status',
            'must_change_password',
            'created_at'
        )
            ->latest()
            ->get();

        return response()->json([
            'users' => $users,
        ]);
    }

    public function deactivate(User $user)
    {
        $user->update([
            'status' => 'inactive',
        ]);

        return response()->json([
            'message' => 'Usuario desactivado correctamente.',
            'user' => $user,
        ]);
    }

    public function resetPassword(User $user)
    {
        $temporaryPassword = \Illuminate\Support\Str::password(10);

        $user->update([
            'password' => bcrypt($temporaryPassword),
            'must_change_password' => true,
        ]);

        return response()->json([
            'message' => 'Contraseña restablecida correctamente.',
            'temporary_password' => $temporaryPassword,
        ]);
    }
}
