<?php

use App\Http\Controllers\Api\MobileController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RoundRobinController;
use App\Http\Controllers\RoundRobinPytonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('gas/{id}', [MobileController::class, 'index']);

Route::controller(DeviceController::class)->prefix('/device')->group(function () {
    Route::post('/amonia', [DeviceController::class, 'amonia']);
    Route::post('/dioksida', [DeviceController::class, 'dioksida']);
    Route::post('/metana', [DeviceController::class, 'metana']);
    Route::post('/temperature', [DeviceController::class, 'temperature']);
    Route::post('/humidity', [DeviceController::class, 'humidity']);
});
Route::get('/test', function () {
    return response()->json(['message' => 'API bekerja!']);
});
Route::get('/round-robin', [RoundRobinController::class, 'roundRobin']);

// Route::post('/roundrobin', [RoundRobinPyton::class, 'calculate']);
Route::get('/fetch-round-robin', [RoundRobinPytonController::class, 'fetchData']);

Route::get('/latest-temperature', function () {
    $latestTemperature = DB::table('temperature')
        ->orderBy('created_at', 'desc')
        ->first();

    return response()->json($latestTemperature);
});

Route::get('/latest-humidity', function () {
    $latestHumidity = DB::table('humidity')
        ->orderBy('created_at', 'desc')
        ->first();

    return response()->json($latestHumidity);
});
