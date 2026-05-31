<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\RecordedClassController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\Admin\RoomController;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);

Route::get('/classes', [ClassController::class, 'index']);
Route::get('/classes/{id}', [ClassController::class, 'show']);

Route::get('/schedules', [ScheduleController::class, 'index']);
Route::get('/schedules/{id}', [ScheduleController::class, 'show']);

Route::get('/plans', [PlanController::class, 'index']);

Route::post('/messages', [MessageController::class, 'store']);

Route::get('/settings', [SettingController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Protected routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::patch('/change-password', [AuthController::class, 'changePassword']);

    // Reservas usuario
    Route::get('/my-reservations', [ReservationController::class, 'myReservations']);
    Route::get('/available-schedules', [ReservationController::class, 'availableSchedules']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::patch('/reservations/{id}/cancel', [ReservationController::class, 'cancel']);


    // Favoritos
    Route::get('/my-favorites', [FavoriteController::class, 'index']);
    Route::post('/favorites/{recordedClass}', [FavoriteController::class, 'store']);
    Route::delete('/favorites/{recordedClass}', [FavoriteController::class, 'destroy']);

    // Clases grabadas
    Route::get('/recorded-classes', [RecordedClassController::class, 'index']);
    Route::get('/recorded-classes/{id}', [RecordedClassController::class, 'show']);

    Route::patch('/profile', [AuthController::class, 'updateProfile']);
});

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/test', function () {
        return response()->json([
            'message' => 'Acceso permitido al panel admin.',
        ]);
    });

    // Usuarios
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate']);
    Route::patch('/users/{user}/reset-password', [UserController::class, 'resetPassword']);

    // Clases
    Route::get('/classes', [ClassController::class, 'index']);
    Route::post('/classes', [ClassController::class, 'store']);
    Route::put('/classes/{class}', [ClassController::class, 'update']);
    Route::patch('/classes/{class}/deactivate', [ClassController::class, 'deactivate']);

    // Horarios
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::post('/schedules', [ScheduleController::class, 'store']);
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update']);
    Route::patch('/schedules/{schedule}/deactivate', [ScheduleController::class, 'deactivate']);

    // Reservas admin
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus']);
    Route::get('/available-schedules', [ReservationController::class, 'availableSchedules']);
    Route::post('/reservations', [ReservationController::class, 'adminStore']);

    // Clases grabadas
    Route::get('/recorded-classes', [RecordedClassController::class, 'adminIndex']);
    Route::post('/recorded-classes', [RecordedClassController::class, 'store']);
    Route::put('/recorded-classes/{id}', [RecordedClassController::class, 'update']);
    Route::patch('/recorded-classes/{id}/deactivate', [RecordedClassController::class, 'deactivate']);

    // Planes
    Route::get('/plans', [PlanController::class, 'index']);
    Route::post('/plans', [PlanController::class, 'store']);
    Route::put('/plans/{plan}', [PlanController::class, 'update']);
    Route::patch('/plans/{plan}/deactivate', [PlanController::class, 'deactivate']);

    // Pagos
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::post('/payments', [PaymentController::class, 'store']);
    Route::patch('/payments/{payment}/status', [PaymentController::class, 'updateStatus']);

    // Mensajes
    Route::get('/messages', [MessageController::class, 'index']);
    Route::patch('/messages/{message}/read', [MessageController::class, 'markAsRead']);
    Route::patch('/messages/{message}/archive', [MessageController::class, 'archive']);
    Route::patch('/messages/{message}/unarchive', [MessageController::class, 'unarchive']);
    Route::patch('/messages/{message}/unread', [MessageController::class, 'markAsUnread']);

    // Settings
    Route::get('/settings', [SettingController::class, 'index']);
    Route::put('/settings', [SettingController::class, 'update']);

    //Room
    Route::get('/rooms', [RoomController::class, 'index']);
});
