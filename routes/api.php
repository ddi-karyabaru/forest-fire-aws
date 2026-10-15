<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorController;

Route::post('/sensor', [SensorController::class, 'store']);
Route::get('/sensor/hourly', [SensorController::class, 'getHourlyAverageData']);
Route::get('/sensor/latest', [SensorController::class, 'getLatest']);