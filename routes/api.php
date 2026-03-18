<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardStatsController;
use App\Http\Controllers\Api\EditRequestController;

/* |-------------------------------------------------------------------------- | API Routes |-------------------------------------------------------------------------- | | Here is where you can register API routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "api" middleware group. Make something great! | */

Route::post('/login', [AuthController::class , 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class , 'logout']);
    Route::get('/dashboard/stats', [DashboardStatsController::class , 'index']);
    Route::get('/edit-requests', [EditRequestController::class, 'index']);
    Route::post('/edit-requests', [EditRequestController::class, 'store']);
    Route::post('/edit-requests/{id}/approve', [EditRequestController::class, 'approve']);
    Route::post('/edit-requests/{id}/reject', [EditRequestController::class, 'reject']);
    Route::get('/user', function (Request $request) {
            return response()->json([
            'id' => $request->user()->id,
            'username' => $request->user()->username,
            'full_name' => $request->user()->full_name,
            'role' => $request->user()->role_code,
            ]);
        }
        );
    });
