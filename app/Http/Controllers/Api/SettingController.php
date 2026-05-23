<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()
            ->pluck('value', 'key');

        return response()->json([
            'status' => 'success',
            'data' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:50',
            'email' => 'sometimes|email|max:255',
            'instagram' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'opening_hours' => 'sometimes|string|max:255',
            'footer_text' => 'sometimes|string|max:500',
        ]);

        foreach ($validated as $key => $value) {
            Setting::where('key', $key)->update([
                'value' => $value,
            ]);
        }

        $settings = Setting::all()
            ->pluck('value', 'key');

        return response()->json([
            'status' => 'success',
            'message' => 'Configuración actualizada correctamente',
            'data' => $settings,
        ]);
    }
}