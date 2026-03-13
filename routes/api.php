<?php

use App\Domains\Children\Controllers\ChildController;
use App\Domains\Guardians\Controllers\ChildGuardianController;
use App\Domains\Guardians\Controllers\GuardianController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/me', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('children', ChildController::class);
    Route::apiResource('guardians', GuardianController::class);

    Route::get('/children/{child}/guardians', [ChildGuardianController::class, 'index']);
    Route::post('/children/{child}/guardians', [ChildGuardianController::class, 'store']);
    Route::delete('/children/{child}/guardians/{guardian}', [ChildGuardianController::class, 'destroy']);
});